<?php

namespace App\Filament\Resources\MenuItems;

use App\Filament\Resources\MenuItems\Pages\CreateMenuItems;
use App\Filament\Resources\MenuItems\Pages\EditMenuItems;
use App\Filament\Resources\MenuItems\Pages\ListMenuItems;
use App\Filament\Resources\MenuItems\Pages\ViewMenuItems;
use App\Filament\Resources\MenuItems\RelationManagers\AddonCategoriesRelationManager;
use App\Filament\Resources\MenuItems\RelationManagers\MenuItemsResourceRelationManager;
use App\Filament\Resources\MenuItems\Schemas\MenuItemsForm;
use App\Filament\Resources\MenuItems\Schemas\MenuItemsInfolist;
use App\Filament\Resources\MenuItems\Tables\MenuItemsTable;
use App\Models\MenuItems;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MenuItemsResource extends Resource
{
    protected static ?string $model = MenuItems::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-book-open';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MenuItemsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MenuItemsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            AddonCategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenuItems::route('/'),
            'create' => CreateMenuItems::route('/create'),
            'view' => ViewMenuItems::route('/{record}'),
            'edit' => EditMenuItems::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('navigation.menu_items');
    }
        public static function getPluralModelLabel(): string
    {
        return __('navigation.menu_items');
    }
    public static function getModelLabel(): string
    {
        return __('menuitem.single');
    }

}
