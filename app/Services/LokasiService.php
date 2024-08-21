<?php

namespace App\Services;

use App\Models\Node;
use App\Models\Lahan;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Auth;

class LokasiService
{
    public function store($request)
    {

        #saving node

        $request['user_id'] = Auth::id();
        $node = Node::create($request->only(['latitude', 'longitude']));
        $node_id = $node->id;

        #saving lahan
        $request->except(['latitude', 'longitude']);
        $request->merge(['node_id' => $node_id]);

        $lahan = Lokasi::create($request->all());

        #upload image
        if ($image = $request->file('image')) {
            $lahan->addMedia($image)->toMediaCollection();
        }

        return $lahan;
    }

    public function update($request, $id)
    {
        $user = Lokasi::find($id);

        #update node
        $node = Node::find($user->node_id);
        $node->latitude = $request->latitude;
        $node->longitude = $request->longitude;
        $node->save();

        #update data
        $user->update($request->all());

        #upload image
        if ($image = $request->file('image')) {
            $user->clearMediaCollection();
            #remove image
            $user->addMedia($image)->toMediaCollection();
        }
    }

    public function destroy($lahan)
    {
        $node_id = $lahan->node_id;

        #hapus lahan
        Lokasi::destroy($lahan->id);
        #hapus node
        Node::destroy($node_id);
    }
}
