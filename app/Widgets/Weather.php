<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use illuminate\View\View;

class Weather extends AbstractWidget
{
    /** @var array $config The configuration array */
    protected $config = [];

    /**
     * Widget view action
     * 
     * @return void
     */
    public function run()
    {
        $id = isset($this->config['id']) ? $this->config['id'] : 'widget';
        $countries = config('constants.countries');

        return view('widgets.weather', [
            'id' => $id,
            'countries' => $countries,
        ]);
    }
}
