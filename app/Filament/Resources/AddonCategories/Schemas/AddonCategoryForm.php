<?php

namespace App\Filament\Resources\AddonCategories\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Schemas\Components\Tabs;

class AddonCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Tabs::make('Translations')
                    ->tabs([
                        Tabs\Tab::make(__('العربية'))
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label(__('addonCategory.name') . ' (بالعربي)')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('description.ar')
                                    ->label(__('addonCategory.description') . ' (بالعربي)')
                                    ->maxLength(65535),
                            ]),
                        Tabs\Tab::make(__('English'))
                            ->schema([
                                TextInput::make('name.en')
                                    ->label(__('addonCategory.name') . ' (EN)')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('description.en')
                                    ->label(__('addonCategory.description') . ' (EN)')
                                    ->maxLength(65535),
                            ]),
                    ])
                    ->columnSpanFull(),

                Checkbox::make('is_active')
                    ->label(__('addonCategory.is_active')),

                FileUpload::make('image')
                    ->label(__('addonCategory.image'))
                    ->image()
                    ->disk('public')
                    ->maxSize(1024)
                    ->maxFiles(1)
                    ->required(),
            ]);
    }
}
