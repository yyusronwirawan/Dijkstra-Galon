<?php

namespace App\Services;

use App\Models\Graf;

class GrafService
{
    public function store($request)
    {
        Graf::create($request->all());
    }
}
