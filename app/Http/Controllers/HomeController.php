<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        return view('front.home');
    }

    public function nodes()
    {
        return Node::get();
    }
}
