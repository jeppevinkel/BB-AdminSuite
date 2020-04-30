<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    public function servers()
    {
        return $this->belongsToMany(Server::class)->withTimestamps();
    }

    public function firstSeen($serverAccount)
    {
        $firstSeen = Carbon::now();
        foreach ($this->servers->where('server_account_id', '=', $serverAccount->id) as $server) {
            if ($server->pivot->created_at->lt($firstSeen)) {
                $firstSeen = $server->pivot->created_at;
            }
        }
        return $firstSeen;
    }

    public function lastSeen($serverAccount)
    {
        $lastSeen = Carbon::createFromTimestamp(0);
        foreach ($this->servers->where('server_account_id', '=', $serverAccount->id) as $server) {
            if ($server->pivot->updated_at->gt($lastSeen)) {
                $lastSeen = $server->pivot->updated_at;
            }
        }
        return $lastSeen;
    }
}
