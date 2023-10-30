<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class listController extends Controller
{
    public function __invoke() : View
    {
        return view('Products.index');
    }
}
