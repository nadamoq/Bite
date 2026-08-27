<?php

namespace App\Filament\Resources\AddonCategories;

use App\Filament\Concerns\HydratesTranslatableAttributes;
use App\Filament\Resources\AddonCategories\Pages\CreateAddonCategory;
use App\Filament\Resources\AddonCategories\Pages\EditAddonCategory;
use App\Filament\Resources\AddonCategories\Pages\ListAddonCategories;
use App\Filament\Resources\AddonCategories\Schemas\AddonCategoryForm;
use App\Filament\Resources\AddonCategories\Tables\AddonCategoriesTable;
use App\Models\Addon;
use App\Models\AddonCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AddonCategoryResource extends Resource
{
    use HydratesTranslatableAttributes;
    protected static ?string $model = AddonCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AddonCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AddonCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            'addons' => RelationManagers\AddonsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAddonCategories::route('/'),
            'create' => CreateAddonCategory::route('/create'),
            'edit' => EditAddonCategory::route('/{record}/edit'),
        ];
    }
    public static function getModelLabel(): string
    {
        return __('navigation.addon category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('navigation.addon categories');
    }


}
