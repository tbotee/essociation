<?php

namespace App\Livewire\Association;

use App\Models\Association;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;

class AssociationList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Association::query())
            ->columns([
                TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable(),
                TextColumn::make('address')
                    ->label(__('address')),
                TextColumn::make('city.name')
                    ->label(__('city'))
                    ->searchable(),
                TextColumn::make('region.name')
                    ->label(__('region'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('phone'))
            ]);
    }

    public function render()
    {
        return view('livewire.association.association-list');
    }
}
