<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class Menuitemschartwidget extends ChartWidget
{
    protected ?string $heading = 'Menuitemschartwidget';
    
    public function mount(): void
    {
        $this->heading = __('widgets.menuitems.description');
    }
    protected function getData(): array
    {
        return [
            //
            'datasets'=>[['label'=>'menu items added','data'=>['0','10','50','60','80']]],
            'labels'=>['jan','feb','march','april']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
