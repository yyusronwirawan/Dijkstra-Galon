<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLokasiRequest;
use App\Http\Requests\UpdateLahanRequest;
use App\Http\Requests\UpdateLokasiRequest;
use App\Models\Lokasi;
use App\Services\LokasiService;

class LokasiController extends Controller
{
    public function __construct(private LokasiService $lokasiService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (Auth::user()->hasRole('Super-Admin')) {
            $lokasis = Lokasi::where('nama', 'like', '%' . $search . '%')
                ->where(function ($q) use ($search) {
                    $q->orWhere('nama', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $lokasis = Lokasi::where('user_id', Auth::id())
                ->where(function ($q) use ($search) {
                    $q->orwhere('nama', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('lokasi.index', compact('lokasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLokasiRequest $request)
    {
        $this->lokasiService->store($request);
        return redirect()->route('lokasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        return view('lokasi.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLokasiRequest $request, $id)
    {
        $this->lokasiService->update($request, $id);
        return redirect()->route('lokasi.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        $this->lokasiService->destroy($lokasi);
        return redirect()->route('lokasi.index')->with('success', 'Data berhasil dihapus');
    }
}
