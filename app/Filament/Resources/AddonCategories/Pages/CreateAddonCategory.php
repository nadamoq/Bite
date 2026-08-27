<?php

namespace App\Filament\Resources\AddonCategories\Pages;

use App\Filament\Resources\AddonCategories\AddonCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
class CreateAddonCategory extends CreateRecord
{
  
    protected static string $resource = AddonCategoryResource::class;
}
