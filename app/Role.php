<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Role extends Model
{
    protected $guarded = [];

    /*** PERMISSIONS ***/
    // Moderations
    CONST BAN_VIEW = 1;
    CONST BAN_MODIFY = 2;
    CONST BAN_REMOVE = 4;
    CONST BAN_ADD = 8;

    CONST WARN_VIEW = 16;
    CONST WARN_MODIFY = 32;
    CONST WARN_REMOVE = 64;
    CONST WARN_ADD = 128;

    // Members
    CONST MEMBER_VIEW = 256;
    CONST MEMBER_ROLE_SET = 512;
    CONST MEMBER_ROLE_SET_UNLIMITED = 1024;

    // Ranks
    CONST RANK_VIEW = 2048;
    CONST RANK_MODIFY = 32768;
    CONST RANK_REMOVE = 65536;
    CONST RANK_ADD = 16384;

    // Players
    CONST PLAYER_VIEW = 4096;

    // Settings
    CONST SETTINGS_VIEW = 8192;

    CONST SERVER_ADD = 100000;

    public function canEditMembers()
    {
        return $this->hasPermission('member_role_set') || $this->hasPermission('member_role_set_unlimited');
    }

    public function canEditRanks()
    {
        return $this->hasPermission('rank_modify') || $this->hasPermission('rank_remove');
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
            case 'warn_view':
                return ($this->permissions & self::WARN_VIEW) ? true : false;
                break;
            case 'warn_modify':
                return ($this->permissions & self::WARN_REMOVE) ? true : false;
                break;
            case 'warn_remove':
                return ($this->permissions & self::WARN_MODIFY) ? true : false;
                break;
            case 'warn_add':
                return ($this->permissions & self::WARN_ADD) ? true : false;
                break;
            case 'server_add':
                return ($this->permissions & self::SERVER_ADD) ? true : false;
                break;
            case 'member_view':
                return ($this->permissions & self::MEMBER_VIEW) ? true : false;
                break;
            case 'member_role_set':
                return ($this->permissions & self::MEMBER_ROLE_SET) ? true : false;
                break;
            case 'member_role_set_unlimited':
                return ($this->permissions & self::MEMBER_ROLE_SET_UNLIMITED) ? true : false;
                break;
            case 'rank_view':
                return ($this->permissions & self::RANK_VIEW) ? true : false;
                break;
            case 'rank_modify':
                return ($this->permissions & self::RANK_MODIFY) ? true : false;
                break;
            case 'rank_remove':
                return ($this->permissions & self::RANK_REMOVE) ? true : false;
                break;
            case 'rank_add':
                return ($this->permissions & self::RANK_ADD) ? true : false;
                break;
            case 'player_view':
                return ($this->permissions & self::PLAYER_VIEW) ? true : false;
                break;
            case 'settings_view':
                return ($this->permissions & self::SETTINGS_VIEW) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }
}
