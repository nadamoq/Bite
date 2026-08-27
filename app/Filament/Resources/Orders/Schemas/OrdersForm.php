<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Filament\Resources\Orders\OrdersResource;
use App\Models\MenuItems;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

use Illuminate\Support\Facades\Auth;

class OrdersForm
{
    // public static function configure(Schema $schema): Schema
    // {
    //     return $schema
    //         ->components([
    //             Group::make()
    //                 ->schema([
    //                     Section::make(__('order.sections.items_info'))
    //                         ->description(__('order.description'))
    //                         ->icon('heroicon-o-shopping-bag')
    //                         ->schema([
    //                             Repeater::make(__('order.items'))
    //                                 ->relationship('items')
    //                                 ->schema([
    //                                     Select::make('menuitem_id')
    //                                         ->label(__("order.menuitem_id"))
    //                                         ->options(MenuItems::pluck('name', 'id'))
    //                                         ->searchable()
    //                                         ->preload()
    //                                         ->live()

    //                                         ->afterStateUpdated(function ($state,  $set, Get $get) {
                                              
    //                                             $price = $state ? (MenuItems::find($state)?->price ?? 0) : 0;
    //                                             $set('unit_price', $price);
                                                
    //                                             OrdersResource::updateTotalPrice($get, $set);
    //                                         })
    //                                         ->required()
    //                                         ->columnSpan(['sm' => 2, 'md' => 6]),

    //                                     TextInput::make('quantity')
    //                                         ->label(__('order.quantity'))
    //                                         ->numeric()
    //                                         ->default(1)
    //                                         ->minValue(1)
    //                                         ->required()
    //                                         ->live()
    //                                         ->afterStateUpdated(fn(Get $get, Set $set) => OrdersResource::updateTotalPrice($get, $set))
    //                                         ->columnSpan(['sm' => 1, 'md' => 3]),

    //                                     TextInput::make('unit_price')
    //                                         ->label(__('order.addon_price'))
    //                                         ->numeric()
    //                                         ->prefix('$')
    //                                         ->readOnly()
    //                                         ->default(0)
    //                                         ->dehydrated()
    //                                         ->columnSpan(['sm' => 1, 'md' => 3]),

    //                                     CheckboxList::make('addons')
    //                                         ->label(__('order.addon'))
    //                                         ->relationship('addons', 'name')
    //                                         ->live()
    //                                         ->afterStateUpdated(fn(Get $get, Set $set) => OrdersResource::updateTotalPrice($get, $set))
    //                                         ->columns(['sm' => 2, 'md' => 3])
    //                                         ->columnSpanFull(),

    //                                     TextInput::make('special_instructions')
    //                                         ->label(__('order.special_instructions'))
    //                                         ->placeholder(__('order.instructions.placeholder'))
    //                                         ->columnSpanFull(),
    //                                 ])
    //                                 ->columns(12)
    //                                 ->defaultItems(1)
    //                                 ->addActionLabel('(+)')
    //                                 ->reorderable(false)
    //                                 ->collapsible()
    //                                 ->itemLabel(
    //                                     fn(array $state): ?string =>
    //                                     isset($state['menuitems_id'])
    //                                         ? MenuItems::find($state['menuitems_id'])?->name . ' (' . __('order.fields.quantity') . ': ' . ($state['quantity'] ?? 1) . ')'
    //                                         : __('order.labels.new_item')
    //                                 )
    //                         ]),

    //                     // Section::make('ملاحظات الطلب')
    //                     //     ->collapsible()
    //                     //     ->collapsed()
    //                     //     ->schema([
    //                     //         Textarea::make('special_instructions')
    //                     //             ->label('ملاحظات عامة للمطبخ')
    //                     //             ->rows(2)
    //                     //             ->columnSpanFull(),
    //                     //     ]),
    //                 ])
    //                 ->columnSpan(['lg' => 2]),


    //             Group::make()
    //                 ->schema([
    //                     Section::make(__('order.sections.order_info'))
    //                         ->icon('heroicon-o-information-circle')
    //                         ->schema([
    //                             TextInput::make('order_number')
    //                                 ->label(__('order.order_number'))
    //                                 ->disabled()
    //                                 ->dehydrated()
    //                                 ->default(fn() => 'ORD-' . strtoupper(uniqid())),

    //                             Select::make('order_type')
    //                                 ->label(__('order.order_type'))
    //                                 ->options(__('order.order_type_options'))
    //                                 ->default('dine-in')
    //                                 ->live()
    //                                 ->required(),

    //                             Select::make('table_number')
    //                                 ->label(__('order.table_number'))
    //                                 ->options(array_combine(range(1, 20), range(1, 20)))
    //                                 ->searchable()
    //                                 ->visible(fn(Get $get) => $get('order_type') === 'dine-in')
    //                                 ->required(fn(Get $get) => $get('order_type') === 'dine-in'),

    //                             Select::make('user_id')
    //                                 ->label(__('order.user'))
    //                                 ->options(User::pluck('name', 'id'))
    //                                 ->default(fn() => auth()->id())
    //                                 ->searchable()
    //                                 ->required(),

    //                             Select::make('status')
    //                                 ->label(__('order.status'))
    //                                 ->options(__('order.statuses'))
    //                                 ->default('pending')
    //                                 ->required(),
    //                         ]),

    //                     Section::make(__('order.sections.summary'))
    //                         ->schema([
    //                             TextInput::make('total_price')
    //                                 ->label(__('order.total_price'))
    //                                 ->numeric()
    //                                 ->prefix('$')
    //                                 ->disabled()
    //                                 ->dehydrated()
    //                                 ->extraInputAttributes(['class' => 'text-xl font-bold text-primary-600']),
    //                         ]),
    //                 ])
    //                 ->columnSpan(['lg' => 1]),
    //         ])
    //         ->columns(3);
    // }
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make(__('order.sections.items_info'))
                            ->description(__('order.description'))
                            ->icon('heroicon-o-shopping-bag')
                            ->schema([
                                Repeater::make('items')
                                    ->label(__('order.items'))
                                    ->relationship('items')
                                    ->schema([
                                        Select::make('menuitem_id')
                                            ->label(__("order.menuitem_id"))
                                            ->options(MenuItems::pluck('name', 'id')->where('is_active',true))
                                            ->searchable()
                                            ->preload()
                                            ->live()
                                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                                $price = $state ? (MenuItems::find($state)?->price ?? 0) : 0;
                                                $set('unit_price', $price);
                                                
                                                OrdersResource::updateTotalPrice($get, $set);
                                            })
                                            ->required()
                                            ->columnSpan(['sm' => 2, 'md' => 6]),

                                        TextInput::make('quantity')
                                            ->label(__('order.quantity'))
                                            ->numeric()
                                            ->default(1)
                                            ->minValue(1)
                                            ->required()
                                            ->live(debounce: 300)
                                            ->afterStateUpdated(fn(Get $get, Set $set) => OrdersResource::updateTotalPrice($get, $set))
                                            ->columnSpan(['sm' => 1, 'md' => 3]),

                                        TextInput::make('unit_price')
                                            ->label(__('order.addon_price'))
                                            ->numeric()
                                            ->prefix('$')
                                            ->readOnly()
                                            ->default(0)
                                            ->dehydrated()
                                            ->columnSpan(['sm' => 1, 'md' => 3]),

                                        CheckboxList::make('addons')
                                            ->label(__('order.addon'))
                                            ->relationship('addons', 'name')
                                            ->live()
                                            ->afterStateUpdated(fn(Get $get, Set $set) => OrdersResource::updateTotalPrice($get, $set))
                                            ->columns(['sm' => 2, 'md' => 3])
                                            ->columnSpanFull(),

                                        TextInput::make('special_instructions')
                                            ->label(__('order.special_instructions'))
                                            ->placeholder(__('order.instructions.placeholder'))
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(12)
                                    ->defaultItems(1)
                                    ->addActionLabel('(+)')
                                    ->reorderable(false)
                                    ->collapsible()
                                    ->itemLabel(
                                        fn(array $state): ?string =>
                                        isset($state['menuitem_id']) && $state['menuitem_id']
                                            ? MenuItems::find($state['menuitem_id'])?->name . ' (' . __('order.quantity') . ': ' . ($state['quantity'] ?? 1) . ')'
                                            : __('order.labels.new_item')
                                    )
                                    ->live()
                                    ->afterStateUpdated(fn(Get $get, Set $set) => OrdersResource::updateTotalPrice($get, $set)),

                                // Section::make('ملاحظات الطلب')
                                //     ->collapsible()
                                //     ->collapsed()
                                //     ->schema([
                                //         Textarea::make('special_instructions')
                                //             ->label('ملاحظات عامة للمطبخ')
                                //             ->rows(2)
                                //             ->columnSpanFull(),
                                //     ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make(__('order.sections.order_info'))
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('order_number')
                                    ->label(__('order.order_number'))
                                    ->disabled()
                                    ->dehydrated()
                                    ->default(fn() => 'ORD-' . strtoupper(uniqid())),

                                Select::make('order_type')
                                    ->label(__('order.order_type'))
                                    ->options(__('order.order_type_options'))
                                    ->default('dine-in')
                                    ->live()
                                    ->required(),

                                Select::make('table_number')
                                    ->label(__('order.table_number'))
                                    ->options(array_combine(range(1, 20), range(1, 20)))
                                    ->searchable()
                                    ->visible(fn(Get $get) => $get('order_type') === 'dine-in')
                                    ->required(fn(Get $get) => $get('order_type') === 'dine-in'),

                                Select::make('user_id')
                                    ->label(__('order.user'))
                                    ->options(User::pluck('name', 'id'))
                                    ->default(fn() => auth()->id())
                                    ->searchable()
                                    ->required(),

                                Select::make('status')
                                    ->label(__('order.status'))
                                    ->options(__('order.statuses'))
                                    ->default('pending')
                                    ->required(),
                            ]),

                        Section::make(__('order.sections.summary'))
                            ->schema([
                                TextInput::make('total_price')
                                    ->label(__('order.total_price'))
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated()
                                    ->default(0)
                                    ->extraInputAttributes(['class' => 'text-xl font-bold text-primary-600']),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
