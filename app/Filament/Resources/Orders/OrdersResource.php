<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\CreateOrders;
use App\Filament\Resources\Orders\Pages\EditOrders;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\Pages\ViewOrders;
use App\Filament\Resources\Orders\Schemas\OrdersForm;
use App\Filament\Resources\Orders\Schemas\OrdersInfolist;
use App\Filament\Resources\Orders\Tables\OrdersTable;
use App\Models\Addon;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class OrdersResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'order_number';

    public static function form(Schema $schema): Schema
    {
        return OrdersForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrdersInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrders::route('/create'),
            'view' => ViewOrders::route('/{record}'),
            'edit' => EditOrders::route('/{record}/edit'),
        ];
    }
    public static function updateTotalPrice(Get $get, Set $set): void
    {
        $items = $get('items') ?? $get('../../items') ?? [];
        $total = 0;

        foreach ($items as $item) {
            $quantity = (int) ($item['quantity'] ?? 1);
            $unitPrice = (float) ($item['unit_price'] ?? 0);

            $addonsPrice = 0;
            if (!empty($item['addons'])) {
                $addonsPrice = Addon::whereIn('id', $item['addons'])->sum('price');
            }

            $total += ($unitPrice + $addonsPrice) * $quantity;
        }

        $set('total_price', $total);
        $set('../../total_price', $total);
    }
    public static function getNavigationLabel(): string
    {
        return __('navigation.orders');
    }
    public static function getPluralModelLabel(): string
    {
        return __('navigation.orders');
    }
    public static function getModelLabel(): string
    {
        return __('navigation.order');
    }
}
