<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerAccount extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);

//        return $this->hasMany(ServerAccount::class, 'server_account_members')
//            ->using(ServerAccountMember::class)
//            ->as('server_account_member')->withPivot('role_id');
    }
}
