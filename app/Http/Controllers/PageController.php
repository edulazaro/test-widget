<?php

namespace App\Http\Controllers;

/**
 * General page controller
 */
class PageController extends Controller
{
    /** @var string $layout The default layout */
    protected $layout = 'layouts.default';

    /**
     * Configure a default layout for all pages
     * 
     * @return void
     */
    protected function setupLayout()
    {
        $this->layout = View::make($this->layout);
    }
}
