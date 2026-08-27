<?php

namespace App\Filament\Concerns;

trait HydratesTranslatableAttributes
{
    /**
     * Expand Spatie JSON translations so Filament can bind name.ar / name.en.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->getRecord();

        if ($record && method_exists($record, 'getTranslatableAttributes')) {
            foreach ($record->getTranslatableAttributes() as $attribute) {
                $data[$attribute] = $record->getTranslations($attribute);
            }
        }

        return $data;
    }
}
