<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Role extends Model
{
    protected $guarded = [];

    CONST BAN_VIEW = 1;
    CONST BAN_MODIFY = 2;
    CONST BAN_REMOVE = 4;
    CONST BAN_ADD = 8;

    public function serverAccount()
    {
        $this->belongsTo(ServerAccount::class);
    }

    public function hasPermission(string $permName)
    {
        switch ($permName) {
            case 'ban_view':
                return ($this->permissions & self::BAN_VIEW) ? true : false;
                break;
            case 'ban_modify':
                return ($this->permissions & self::BAN_MODIFY) ? true : false;
                break;
            case 'ban_remove':
                return ($this->permissions & self::BAN_REMOVE) ? true : false;
                break;
            case 'ban_add':
                return ($this->permissions & self::BAN_ADD) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }
}
