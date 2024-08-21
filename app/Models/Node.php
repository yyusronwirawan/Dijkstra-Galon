<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Node extends Model
{
    use HasFactory;

    protected $with = ['lokasi'];

    protected $fillable = [
        'latitude',
        'longitude'
    ];

    public function lokasi(): HasOne
    {
        return $this->hasOne(Lokasi::class, 'node_id', 'id');
    }
}
