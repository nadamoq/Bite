<?php

namespace App\Filament\Resources\Addons;

use App\Filament\Resources\Addons\Pages\CreateAddons;
use App\Filament\Resources\Addons\Pages\EditAddons;
use App\Filament\Resources\Addons\Pages\ListAddons;
use App\Filament\Resources\Addons\Pages\ViewAddons;
use App\Filament\Resources\Addons\Schemas\AddonsForm;
use App\Filament\Resources\Addons\Schemas\AddonsInfolist;
use App\Filament\Resources\Addons\Tables\AddonsTable;
use App\Models\Addon;
use App\Models\Addons;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;

class AddonsResource extends Resource
{
    protected static ?string $model = Addon::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-sparkles';
     protected static ?string $navigationParentItem = 'Addon Categories';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AddonsForm::configure($schema);
    }
   
    #[Override]
    public static function getNavigationBadge(): ?string
    {
        return __('navigation.new');
    }
    #[Override]
	public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
    public static function infolist(Schema $schema): Schema
    {
        return AddonsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AddonsTable::configure($table);
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
            'index' => ListAddons::route('/'),
            'create' => CreateAddons::route('/create'),
            'view' => ViewAddons::route('/{record}'),
            'edit' => EditAddons::route('/{record}/edit'),
        ];
    }

   
    public static function getNavigationParentItem(): ?string
    {
        return __('navigation.addon categories'); 
    
    }
    public static function getModelLabel(): string
    {
        return __('addon.single');
    }

    public static function getPluralModelLabel(): string
    {
        return __('addon.plural');
    }
    #[Override]
    public static function getNavigationLabel(): string
    {
        return __('addon.plural');
    }


    
}
