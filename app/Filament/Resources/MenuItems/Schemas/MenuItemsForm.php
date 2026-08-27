<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;


class MenuItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make(__('menuitem.details'))->schema([
                    Group::make([])->schema([
                        Tabs::make('Translations')
                            ->tabs([
                                Tabs\Tab::make(__('العربية'))
                                    ->schema([
                                        TextInput::make('name.ar')
                                            ->required()
                                            ->maxLength(150)
                                            ->label(__('menuitem.name') . ' (بالعربي)'),
                                        TextInput::make('description.ar')
                                            ->maxLength(255)
                                            ->label(__('menuitem.description') . ' (بالعربي)'),
                                    ]),
                                Tabs\Tab::make(__('English'))
                                    ->schema([
                                        TextInput::make('name.en')
                                            ->required()
                                            ->maxLength(150)
                                            ->label(__('menuitem.name') . ' (EN)'),
                                        TextInput::make('description.en')
                                            ->maxLength(255)
                                            ->label(__('menuitem.description') . ' (EN)'),
                                    ]),
                            ]),
                        TextInput::make('price')->required()->numeric()->label(__('menuitem.price')),

                    ]),
                ])->columnSpan(2),

                Section::make([])->heading(__('menuitem.view'))->schema([
                    Group::make([])->schema([
                        FileUpload::make('image')
                            ->image()
                            ->label(__('menuitem.image'))
                            ->disk('public')
                            ->maxSize(1024),
                        Toggle::make('is_active')->label(__('menuitem.is_active')),
                    ])
                ])->columnSpan(1),



                Section::make(__('menuitem.addtional_details'))->schema([
                    Group::make([])->schema([
                        TextInput::make('weight')
                            ->label(__('menuitem.weight'))
                            ->numeric(),
                        Select::make('num_people')
                            ->required()
                            ->label(__('menuitem.num_people'))
                            ->options([
                                1 => 1,
                                2 => 2,
                                5 => 5,
                            ])
                            ->default(1),

                        Select::make('category_id')
                            ->label(__('menuitem.category'))
                            ->relationship('activeCategory', 'title')
                            ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('title', app()->getLocale()))
                            ->exists(Category::class, 'id'),

                    ]),


                ])->columnSpan(2),

            ])->columns(3);
    }
}
