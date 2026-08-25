<?php

namespace App\Filament\Resources\Addons\Schemas;

use App\Filament\Resources\AddonCategories\RelationManagers\AddonsRelationManager;
use Dom\Text;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AddonsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->label(__('addon.name'))
                    ->required()
                
                    ->maxLength(255),
                TextInput::make('description')
                    ->label(__('addon.description'))
                    ->maxLength(65535),
                Checkbox::make('is_active')
                    ->label(__('addon.is_active')),
                TextInput::make('price')
                    ->label(__('addon.price'))
                    ->numeric()
                    ->required(),
                Select::make('addon_category_id')
                    ->label(__('navigation.addon category'))
                    ->relationship('category', 'name')
                    ->required(),
                
            ]);
    }
}
