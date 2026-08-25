<?php

namespace App\Filament\Resources\MenuItems\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MenuItemsTable
{
   
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->label(__('menuitem.id'))
                    ->sortable(),
                ImageColumn::make('image')->disk('public')->circular()->label(__('menuitem.image')),
                TextColumn::make('name')->label(__('menuitem.name'))
                    ->searchable(),
                // TextColumn::make('description'),
                TextColumn::make('price')->label(__('menuitem.price'))
                    ->sortable(),
                TextColumn::make('weight')->label(__('menuitem.weight')),
                TextColumn::make('num_people')
                    ->label(__('menuitem.num_people')),
                TextColumn::make('category.title')
                    ->label(__('menuitem.category'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->label(__('menuitem.is_active'))
                    ->boolean(),
            ])
            ->searchDebounce('750ms')
            //تستخدم لتاخير او تقليل وقت البحث عند الكتابة في حقل البحث، بحيث يتم الانتظار لمدة 750 مللي ثانية بعد توقف المستخدم عن الكتابة قبل تنفيذ عملية البحث. هذا يساعد على تحسين الأداء وتقليل عدد الاستعلامات المرسلة إلى قاعدة البيانات.
            ->searchOnBlur()
            //تستخدم لتفعيل البحث عند فقدان التركيز من حقل البحث، أي عندما ينقر المستخدم خارج حقل البحث بعد إدخال النص. هذا يعني أن عملية البحث لن تتم إلا بعد أن يترك المستخدم حقل البحث، مما يقلل من عدد الاستعلامات المرسلة أثناء الكتابة.
            ->filters([
                //
                SelectFilter::make('category.title')->label(__('menuitem.category'))->relationship('activeCategory','title')->searchable()->preload()->multiple(),
                TernaryFilter::make('is_active')->label(__('menuitem.is_active'))->trueLabel(__('menuitem.is_active'))->falseLabel(__('menuitem.labels.in_active'))->placeholder(__('all'))
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
