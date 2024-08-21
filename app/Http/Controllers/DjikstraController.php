<?php

namespace App\Http\Controllers;

use App\Models\Graf;
use App\Models\Node;
use Illuminate\Http\Request;
use App\Services\DjikstraService;

class DjikstraController extends Controller
{
    public function __construct()
    {
    }

    public function heuristik($start)
    {
        $nodes = Node::all();

        $temp_ = [];
        foreach ($nodes as $n) {
            $temp_[$n['id']] = round(sqrt(pow($start['latitude'] - $n['latitude'], 2) + pow($start['longitude'] - $n['longitude'], 2)) * 111.319, 2);
        }
        asort($temp_);
        return $temp_;
    }

    public function setCurrentAsStart(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $heuristik = $this->heuristik(['latitude' => $lat, 'longitude' => $lng]);
        $shortestNode = array_keys($heuristik)[0];
        $request->session()->put('start', (string)$shortestNode);
        dd(session('start'));
    }

    public function setStartPoint(Request $request)
    {
        $request->session()->put('start', $request->query('id'));
    }

    public function setEndPoint(Request $request)
    {
        $request->session()->put('end', $request->query('id'));
    }

    public function getShortestPath()
    {
        $djikstra = new DjikstraService();
        $path = explode(',', $djikstra->printPath());




        $result = array();
        $result['coordinates'] = [];
        $result['path'] = [];
        $result['start'] = Node::find(session('start'))->toArray();
        $result['end'] = Node::find(session('end'))->toArray();
        $result['distance'] = round($djikstra->getDistance() / 1000, 2) . 'Km';
        $result['time'] = round($djikstra->getDistance() / 150,0)  . ' Menit';
        $result['perhitungan'] = $djikstra->getDetailPerhitungan();


        for ($i = 0; $i < count($path) - 1; $i++) {
            $graf = Graf::where('start', $path[$i])->where('end', $path[$i + 1])->first()->toArray();

            array_push($result['coordinates'], $graf['rute']);
            array_push($result['path'], ($graf['node_start']['lokasi']['nama'] ?? 'Node ' . $graf['node_start']['id']) . ' <i class="bi bi-arrow-right"></i> ' . ($graf['node_end']['lokasi']['nama'] ?? 'Node ' . $graf['node_end']['id']));
        }

        echo json_encode($result);
        // print $djikstra->printPath();
        // print "\n";
        // print $djikstra->getDistance();
        // print "\n";
        // print $djikstra->getDetailPerhitungan();
    }
}
