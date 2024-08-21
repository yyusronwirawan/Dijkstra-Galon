<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiFrontController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $lokasis = Lokasi::where('nama', 'like', '%' . $search . '%')->paginate(10);
        return view('front.list-lokasi', compact('lokasis'));
    }

    public function show(Lokasi $lokasi)
    {
        return view('front.detail-lokasi', compact('lokasi'));
    }
}
