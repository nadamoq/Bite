<?php

namespace App\Models\Concerns;

trait ProvidesTranslationMap
{
    /**
     * Full locale map for Alpine.js: item.name[locale]
     *
     * @return array{ar: string, en: string}
     */
    public function translationsMap(string $attribute): array
    {
        $translations = method_exists($this, 'getTranslations')
            ? $this->getTranslations($attribute)
            : [];

        if ($translations === []) {
            $raw = $this->getAttributes()[$attribute] ?? null;

            if (is_string($raw) && $raw !== '') {
                $decoded = json_decode($raw, true);
                $translations = is_array($decoded)
                    ? $decoded
                    : ['ar' => $raw, 'en' => $raw];
            }
        }

        return [
            'ar' => (string) ($translations['ar'] ?? $translations['en'] ?? ''),
            'en' => (string) ($translations['en'] ?? $translations['ar'] ?? ''),
        ];
    }
}
