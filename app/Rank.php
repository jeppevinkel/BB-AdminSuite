<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $guarded = [];

    public function serverAccount()
    {
        return $this->belongsTo(ServerAccount::class);
    }
}
