<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use App\Models\AssociationUserInvitation;
use App\Models\ResidenceUserInvitation;
use App\Models\Unit;
use App\Traits\PageFullWidth;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Crypt;
use Filament\Tables;
use Filament\Forms;
use Closure;


class InviteResidenceUsers  extends ManageRelatedRecords
{
    use PageFullWidth;

    protected static string $resource = UnitResource::class;

    protected static string $relationship = 'userInvitations';

    public function getBreadcrumb(): string
    {
        return 'Invitations';
    }

    public static function getNavigationLabel(): string
    {
        return 'Invitations';
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('residence.nr'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        (string) config('constants.invitationStatus.pending') => 'warning',
                        (string) config('constants.invitationStatus.accepted') => 'success',
                        (string) config('constants.invitationStatus.rejected') => 'danger'
                    })
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        config('constants.invitationStatus.pending') => __('pending'),
                        config('constants.invitationStatus.accepted') => __('accepted'),
                        config('constants.invitationStatus.rejected') => __('rejected'),
                    })

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $unit = $this->getRelationship()->getParent();
                        $data['unit_id'] = $unit->id;
                        $data['encrypted_data'] = Crypt::encryptString(json_encode($data));
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->rules([
                        fn (): Closure => function (string $attribute, $value, Closure $fail) {
                            $unit = $this->getRelationship()->getParent();
                            $exists = ResidenceUserInvitation::where('email', $value)
                                ->where('unit_id',$unit->id)
                                ->exists();
                            if ($exists) {
                                $fail(__('invitation_exists'));
                            }
                        },
                    ]),
                Forms\Components\Select::make('residence_id')
                    ->label('Author')
                    ->options(
                        function () {
                            $unit = $this->getOwnerRecord();
                            return $unit->residences()->pluck('nr', 'id');

                        }
                    )
            ]);
    }

}
