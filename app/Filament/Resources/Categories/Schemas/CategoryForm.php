<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class CategoryForm
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
                TextInput::make('title.ar')
                    ->label(__('category.title') . ' (بالعربي)')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description.ar')
                    ->label(__('category.description') . ' (بالعربي)')
                    ->maxLength(65535),
            ]),
        Tabs\Tab::make(__('English'))
            ->schema([
                TextInput::make('title.en')
                    ->label(__('category.title') . ' (EN)')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description.en')
                    ->label(__('category.description') . ' (EN)')
                    ->maxLength(65535),
            ]),
    ])
    ->columnSpanFull(),

// TextInput::make('slug')
//     ->label('Slug')
//     ->required()
//     ->unique()
//     ->maxLength(255),

FileUpload::make('image')
    ->label(__('category.image'))
    ->image()
    ->maxSize(1024),

Checkbox::make('is_active')
    ->label(__('category.is_active')),
            ]);
    }
}
