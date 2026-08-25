<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('title')
                    ->label(__('category.title'))
                    ->required()
                    ->unique()
                    ->maxLength(255),
                // TextInput::make('slug')
                //     ->label('Slug')
                //     ->required()
                //     ->unique()
                //     ->maxLength(255),
                Textarea::make('description')
                    ->label(__('category.description'))
                    ->maxLength(65535),
                FileUpload::make('image')
                    ->label(__('category.image'))
                    ->image()
                    ->maxSize(1024),
                Checkbox::make('is_active')
                    ->label(__('category.is_active')),
            ]);
    }
}
