<?php

namespace App\Filament\Resources\MenuItems\Pages;

use App\Filament\Resources\MenuItems\MenuItemsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuItems extends CreateRecord
{
    // use CreateRecord\Concerns\Translatable;
    protected static string $resource = MenuItemsResource::class;
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\LocaleSwitcher::make(), // زر التبديل بين اللغات في الهيدر
    //     ];
    // }
}
