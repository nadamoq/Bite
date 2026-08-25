<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('order_number')
                    ->label(__('order.order_number'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('user_id')
                    ->formatStateUsing(fn($state)=>User::where('id',$state)->first()->name)
                    ->label(__('order.user'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order_type')
                    ->label(__('order.order_type'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dine-in' => 'info',
                        'takeaway' => 'warning',
                        'delivery' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __("order.order_type_options.{$state}") ?? $state),

                TextColumn::make('table_number')
                    ->label(__('order.table_number'))
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('items_count')
                    ->label(__('order.items'))
                    ->counts('items')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('total_price')
                    ->label(__('order.total_price'))
                    ->money('USD')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

                TextColumn::make('status')
                    ->label(__('order.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __("order.statuses.{$state}") ?? $state),

                TextColumn::make('created_at')
                    ->label(__('order.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('order.status'))
                    ->options(__('order.statuses')),

                SelectFilter::make('order_type')
                    ->label(__('order.order_type'))
                    ->options(__('order.order_type_options')),
            ])
   
            
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
