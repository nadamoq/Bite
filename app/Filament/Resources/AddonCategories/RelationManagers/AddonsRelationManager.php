<?php

namespace App\Filament\Resources\AddonCategories\RelationManagers;

use App\Filament\Resources\AddonCategories\Pages\EditAddonCategory;
use App\Filament\Resources\Addons\AddonsResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class AddonsRelationManager extends RelationManager
{
    protected static string $relationship = 'addons';

    protected static ?string $relatedResource = AddonsResource::class;

   
    public static function getRelationshipName(): string
    {
        return 'addons';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),

            ])
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->label(__('addon.name')),
                TextColumn::make('price')->sortable()->label(__('addon.price')),
                IconColumn::make('is_active')->boolean()->label(__('addon.is_active')),
            ])->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
    public static function getModelLabel(): string
    {
        return __('navigation.addon');
    }
    public static function getPluralModelLabel(): string
    {
        return __('navigation.addons');
    }
}
