<?php

namespace App\Filament\Widgets;

use App\Models\AddonCategory;
use App\Models\MenuItems as ModelsMenuItems;
use App\Models\Order;
use App\Models\OrderItem;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MenuItems extends StatsOverviewWidget
{
    protected function getStats(): array
    {
    
        $mostOrdered = OrderItem::query()
            ->selectRaw('menuitem_id, SUM(quantity) as total_quantity')
            ->groupBy('menuitem_id')
            ->orderByDesc('total_quantity')
            ->first();

        $mealName = $mostOrdered 
            ? ModelsMenuItems::find($mostOrdered->menuitem_id)?->name 
            : '0';

        $totalQty = $mostOrdered ? $mostOrdered->total_quantity : 0;

        return [
            Stat::make(__('navigation.menu_items'), ModelsMenuItems::count())
                ->description(__('widgets.menuitems.description'))
                ->descriptionIcon('heroicon-o-book-open', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([20, 30, 20, 40, 50, 80, 200])
                ->color('success'),

            Stat::make(__('navigation.addon categories'), AddonCategory::active()->count())
                ->description(__('widgets.addoncategory.description'))
                ->descriptionIcon('heroicon-o-tag', IconPosition::Before)
                ->descriptionColor('primary')
                ->chart([20, 200, 20, 80, 50, 80, 200])
                ->color('primary'),

            Stat::make(__('navigation.orders'), Order::count())
                ->description(__('widgets.order.description'))
                ->descriptionIcon('heroicon-o-book-open')
                ->descriptionColor('danger')
                ->chart([20, 30, 20, 40, 50, 80, 200])
                ->color('danger'),

            Stat::make(__('widgets.mostOrdered'), $mealName)
                ->description(__('widgets.mostOrdered.description') . " {$totalQty}")
                ->descriptionIcon('heroicon-o-fire')
                ->descriptionColor('success')
                ->chart([10, 25, 45, 60, 85, 120])
                ->color('success'),
        ];
    }
}