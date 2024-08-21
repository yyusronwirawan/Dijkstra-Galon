<?php

namespace App\Http\Controllers;

use App\Models\Graf;
use App\Models\Node;
use App\Models\Lahan;
use Illuminate\Http\Request;
use App\Services\GrafService;
use App\Services\NodeService;
use App\Http\Requests\StoreGrafRequest;
use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateGrafRequest;

class GrafController extends Controller
{
    public function __construct(private GrafService $grafService, private NodeService $nodeService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->query('search');
        $grafs = Graf::orderBy('id', 'desc')->paginate(10);


        return view('graf.index', compact('grafs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nodes = Node::all();
        return view('graf.create', compact('nodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrafRequest $request)
    {
        $this->grafService->store($request);
        return redirect()->route('grafs.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Graf $graf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Graf $graf)
    {
        $this->nodeService->destroy($graf);
        return redirect()->route('grafs.index')->with('success', 'Data berhasil dihapus');
    }

    public function getNodes()
    {
        return Node::get();
    }

    public function storeNode(StoreNodeRequest $storeNodeRequest)
    {
        $this->nodeService->store($storeNodeRequest);
        return response()->json(['status' => 'Data berhasil ditambahkan']);
    }
}
