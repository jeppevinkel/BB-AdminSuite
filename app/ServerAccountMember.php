<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ServerAccountMember extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serverAccount()
    {
        return $this->belongsTo(ServerAccount::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
