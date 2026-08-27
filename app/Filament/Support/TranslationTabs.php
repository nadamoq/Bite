<?php

namespace App\Filament\Support;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class TranslationTabs
{
    /**
     * Filament v5 tabs that write directly into Spatie JSON keys (name.ar, name.en).
     */
    public static function make(
        string $nameField,
        string $nameLabel,
        ?string $descriptionField = null,
        ?string $descriptionLabel = null,
        int $nameMaxLength = 150,
        int $descriptionMaxLength = 255,
    ): Tabs {
        $locales = [
            'ar' => __('menuitem.locale_ar'),
            'en' => __('menuitem.locale_en'),
        ];

        $tabs = [];

        foreach ($locales as $locale => $label) {
            $fields = [
                TextInput::make("{$nameField}.{$locale}")
                    ->label($nameLabel)
                    ->required()
                    ->maxLength($nameMaxLength),
            ];

            if ($descriptionField) {
                $fields[] = TextInput::make("{$descriptionField}.{$locale}")
                    ->label($descriptionLabel)
                    ->maxLength($descriptionMaxLength);
            }

            $tabs[] = Tab::make($locale)
                ->label($label)
                ->schema($fields);
        }

        return Tabs::make(__('menuitem.translations'))
            ->tabs($tabs)
            ->columnSpanFull();
    }
}
