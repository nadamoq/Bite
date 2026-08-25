<?php

namespace App\Filament\Resources\AddonCategories\Pages;

use App\Filament\Resources\AddonCategories\AddonCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAddonCategory extends EditRecord
{
    protected static string $resource = AddonCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
