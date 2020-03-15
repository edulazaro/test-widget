<?php

namespace App\Http\Controllers;

use illuminate\View\View;
use Illuminate\Http\Request;

/**
 * Main controller
 */
class HomeController extends PageController
{
	/**
	 * Index page
	 * 
	 * @return View
	 */
    public function index()
    {
		return view('index');
	}
}
