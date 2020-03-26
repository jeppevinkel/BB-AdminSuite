<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerToken extends Model
{
    protected $guarded = [];

    public $incrementing = false;
    protected $primaryKey = 'token';
}
