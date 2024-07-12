<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() : \Illuminate\View\View {
        return view('app');
    }

    public function getHomeData() {
        return response()->json([
            'user_count' => \App\Models\User::count(),
            'product_count' => \App\Models\Product::count()
        ]);
    }
}
