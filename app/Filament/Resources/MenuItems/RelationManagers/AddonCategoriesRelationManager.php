<?php

namespace App\Filament\Resources\MenuItems\RelationManagers;

use App\Filament\Resources\AddonCategories\AddonCategoryResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\AttachAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AddonCategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'addonCategories';

    protected static ?string $relatedResource = AddonCategoryResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('category.title'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()->preloadRecordSelect(),
            ]);
    }
}
