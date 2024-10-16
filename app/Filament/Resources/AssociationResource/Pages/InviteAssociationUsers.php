<?php

namespace App\Filament\Resources\AssociationResource\Pages;

use App\Filament\Resources\AssociationResource;
use App\Models\AssociationUserInvitation;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Support\Facades\Crypt;
use Closure;

class InviteAssociationUsers extends ManageRelatedRecords
{
    protected static string $resource = AssociationResource::class;

    protected static string $relationship = 'userInvitation';

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
                Tables\Columns\TextColumn::make('role_id')
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        config('constants.roles.admin') => __('admin'),
                        config('constants.roles.chairman') => __('chairman')
                    }),
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
                        $association = $this->getRelationship()->getParent();
                        $data['association_id'] = $association->id;
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
                            $association = $this->getRelationship()->getParent();
                            $exists = AssociationUserInvitation::where('email', $value)
                                ->where('association_id',$association->id)
                                ->exists();
                            if ($exists) {
                                $fail(__('invitation_exists'));
                            }
                        },
                    ]),
                Forms\Components\Radio::make('role_id')
                    ->required()
                    ->options([
                        config('constants.roles.admin') => __('admin'),
                        config('constants.roles.chairman') => __('chairman')
                    ])
            ]);
    }
}
