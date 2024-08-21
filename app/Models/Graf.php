<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Graf extends Model
{
    use HasFactory;

    protected $with = ['nodeStart', 'nodeEnd'];

    protected $fillable = ['start', 'end', 'jarak', 'rute'];

    public function jarak(): Attribute
    {
        return Attribute::make(
            fn (string $value) => $value,
        );
    }

    public function nodeStart(): HasOne
    {
        return $this->hasOne(Node::class, 'id', 'start');
    }

    public function nodeEnd(): HasOne
    {
        return $this->hasOne(Node::class, 'id', 'end');
    }
}
