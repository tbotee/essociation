<?php

namespace App\Livewire\Association;

use App\Models\Association;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Illuminate\View\View;

class AssociationList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Association::query())
            ->defaultGroup('region.name')
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
            ])
            ->emptyStateHeading(__('no_associations'))
            ->headerActions([
                Action::make('Add New')
                    ->label('Add New')
                    ->icon('heroicon-o-plus') // You can choose an icon
                    ->color('primary') // Choose color
                    ->action(fn () => $this->openModal()), // Define your action
            ])
            ->heading(__('associations'))
            ->deferLoading();

    }

    protected function getHeader(): View
    {
        return view('filament.association.table-header', [
            'addNewButton' => Action::make('Add New')
                ->label('Add New')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->action(fn () => $this->openModal()),
        ]);
    }

    public function render()
    {
        return view('livewire.association.association-list');
    }

    protected function openModal()
    {
        $this->dispatch('open-modal', 'add-association');
    }
}
