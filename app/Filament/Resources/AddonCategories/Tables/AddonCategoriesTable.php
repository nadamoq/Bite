<?php

namespace App\Filament\Resources\AddonCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddonCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label(__('addonCategory.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('addonCategory.description')),
                IconColumn::make('is_active')
                    ->label(__('addonCategory.is_active'))
                    ->boolean(),   
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
