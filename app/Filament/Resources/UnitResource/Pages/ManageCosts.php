<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use App\Traits\PageFullWidth;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;

class ManageCosts extends ManageRelatedRecords
{
    use PageFullWidth;

    protected static string $resource = UnitResource::class;

    protected static string $relationship = 'costs';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public function getBreadcrumb(): string
    {
        return 'Costs';
    }

    public static function getNavigationLabel(): string
    {
        return 'Costs';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\Radio::make('type')
                    ->options(
                        function (): array {
                            $return = [];
                            foreach (config('constants.associationCosts') as $index => $cost) {
                                if (config('constants.associationCosts.divideAcrossUnits') === $cost) {
                                    continue;
                                }
                                $return[$cost] = __($index);
                            }
                            return $return;
                        }
                    )
                    ->required(),
                Forms\Components\Toggle::make('is_monthly')
                    ->onIcon('heroicon-o-arrow-path-rounded-square')
                    ->reactive(),
                Forms\Components\DatePicker::make('date')
                    ->format('d/m/Y')
                    ->visible(
                        fn (Get $get): bool => $get('is_monthly') === null || $get('is_monthly') === false
                    )
                    ->required(fn (Get $get): bool => $get('is_monthly') != null || $get('is_monthly') === false)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name')),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label(__('association')),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('amount')),
                Tables\Columns\IconColumn::make('is_monthly')
                    ->label(__('is_monthly_cost'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->trueColor('info')
                    ->falseIcon('')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('date')
                    ->label(__('date'))
                    ->formatStateUsing(function (Carbon $state) {
                        return __($state->format('d/m/Y'));
                    }),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('cost_type'))
                    ->formatStateUsing(function (int $state) {
                        $index = array_search($state, config('constants.associationCosts'));
                        return __($index);
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => $this->manageSave($data)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => $this->manageSave($data)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    private function manageSave(array $data): array {
        $association = $this->getRelationship()->getParent();
        $data['association_id'] = $association->id;
        if (!empty($data['date'])) {
            $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
        }
        return $data;
    }
}
