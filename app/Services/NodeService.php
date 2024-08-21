<?php

namespace App\Services;

use App\Models\Node;

class NodeService
{
    public function store($request)
    {
        $request['tipe'] = '-';
        return Node::create($request->all());
    }

    public function destroy($node)
    {
        $node->delete();
    }
}
