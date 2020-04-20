<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    public function servers()
    {
        return $this->belongsToMany(Server::class);
    }
}
