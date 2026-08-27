<?php

namespace App\Filament\Resources\Addons\Schemas;

use App\Filament\Resources\AddonCategories\RelationManagers\AddonsRelationManager;
use Dom\Text;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class AddonsForm
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
                                    ->label(__('addon.name') . ' (بالعربي)')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('description.ar')
                                    ->label(__('addon.description') . ' (بالعربي)')
                                    ->maxLength(65535),
                            ]),
                        Tabs\Tab::make(__('English'))
                            ->schema([
                                TextInput::make('name.en')
                                    ->label(__('addon.name') . ' (EN)')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('description.en')
                                    ->label(__('addon.description') . ' (EN)')
                                    ->maxLength(65535),
                            ]),
                    ])
                    ->columnSpanFull(),

                Checkbox::make('is_active')
                    ->label(__('addon.is_active')),

                TextInput::make('price')
                    ->label(__('addon.price'))
                    ->numeric()
                    ->required(),

                Select::make('addon_category_id')
                    ->label(__('navigation.addon category'))
                    ->relationship('category', 'name')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', app()->getLocale()))
                    ->required(),
            ]);
    }
}
