<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Server extends Model
{
    protected $guarded = [];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function linkServer(string $token)
    {
        $serverToken = ServerToken::all()->where('expiry_date', '>', Carbon::now())->find($token);

        if (!$serverToken) {
            throw new \Exception('Invalid token');
        }

        DB::beginTransaction();
        try {
            $this->server_account_id = $serverToken->server_account_id;
            $this->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $serverToken->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $this;
    }
}
