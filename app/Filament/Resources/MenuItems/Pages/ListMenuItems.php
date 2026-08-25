<?php

namespace App\Filament\Resources\MenuItems\Pages;

use App\Filament\Resources\MenuItems\MenuItemsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use Filament\Schemas\Components\Tabs\Tab;
use Override;

class ListMenuItems extends ListRecords
{
    protected static string $resource = MenuItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            Tab::make('All')
                ->label(__('menuitem.labels.all')),
          
                Tab::make(__('category.meats'))->query(function($query) {
                    $query->whereHas('category', function($query) {
                        $query->where('title', __('category.meats'));
                    });
                }),
                    Tab::make(__('category.drinks'))->query(function($query) {
                    $query->whereHas('category', function($query) {
                        $query->where('title', __('category.drinks'));
                    });
                }),
                   
        ];
    }
}
