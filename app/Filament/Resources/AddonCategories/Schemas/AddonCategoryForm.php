<?php

namespace App\Filament\Resources\AddonCategories\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AddonCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
             TextInput::make('name')
                    ->label(__('addonCategory.name'))
                    ->required()
                
                    ->maxLength(255),
                TextInput::make('description')
                    ->label(__('addonCategory.description'))
                    ->maxLength(65535),
                Checkbox::make('is_active')
                    ->label(__('addonCategory.is_active')),
                FileUpload::make('image')
                    ->label(__('addonCategory.image'))
                    ->image()
                    ->maxSize(1024)
                    ->maxFiles(1)
                    ->required(),
            ]);
    }
}
