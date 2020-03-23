<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerAccount extends Model
{
    protected $guarded = [];

    public static function createNew(int $userId, string $name, int $planLevel)
    {
        $user = User::find($userId);

        $serverAccount = new ServerAccount([
            'name' => $name,
            'plan_level' => $planLevel,
        ]);
        $serverAccount->save();

        $serverAccountMember = new ServerAccountMember([
            'role_id' => 1,
            'server_account_id' => $serverAccount->id,
            'user_id' => $userId,
        ]);
        $serverAccountMember->save();

        $user->serverAccountMembers()->attach($serverAccountMember);

        return $serverAccount;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
