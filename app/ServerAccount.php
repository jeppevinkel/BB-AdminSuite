<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServerAccount extends Model
{
    protected $guarded = [];

    public static function createNew(int $userId, string $name, int $planLevel)
    {
        $user = User::find($userId);

        if (!$user) {
            throw new \Exception('Specified user id doesn\'t exist!');
        }

        DB::transaction();

        try {
            $serverAccount = new ServerAccount([
                'name' => $name,
                'plan_level' => $planLevel,
            ]);
            $serverAccount->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $serverAccountMember = new ServerAccountMember([
                'role_id' => 1,
                'server_account_id' => $serverAccount->id,
                'user_id' => $userId,
            ]);
            $serverAccountMember->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $user->serverAccountMembers()->save($serverAccountMember);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $serverAccount;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
