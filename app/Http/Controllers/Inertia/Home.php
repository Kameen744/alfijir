<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Home extends Controller
{
    public function index()
    {
        return Inertia::render('home', [
            'data' => ['foo' => 'bar']
        ]);
    }
}
