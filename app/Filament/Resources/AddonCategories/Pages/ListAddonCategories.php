<?php

namespace App\Filament\Resources\AddonCategories\Pages;

use App\Filament\Resources\AddonCategories\AddonCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAddonCategories extends ListRecords
{
    protected static string $resource = AddonCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
