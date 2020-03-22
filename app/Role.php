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
        return $this;
        switch ($permName) {
            case 'ban_view':
                return $this->permissions & self::BAN_VIEW;
                break;
            case 'ban_modify':
                return $this->permissions & self::BAN_MODIFY;
                break;
            case 'ban_remove':
                return $this->permissions & self::BAN_REMOVE;
                break;
            case 'ban_add':
                return $this->permissions & self::BAN_ADD;
                break;
            default:
                return false;
                break;
        }
    }
}
