<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() : \Illuminate\View\View {
        dd('12');
        return view('app', ['data' => 32]);
    }
}
