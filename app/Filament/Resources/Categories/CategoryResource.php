<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category as ModelsCategory;
use BackedEnum;
use Category;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;

class CategoryResource extends Resource
{
    protected static ?string $model = ModelsCategory::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-tag';
    protected static ?string $recordTitleAttribute = 'title';
    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
    #[Override]
    public static function getNavigationLabel(): string
    {
        return __('navigation.categories');
    }
    public static function getPluralModelLabel(): string
    {
        return __('navigation.categories');
    }
       public static function getModelLabel(): string
    {
        return __('navigation.category');
    }
}
