<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'server_account_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cover' => 'boolean',
        'hidden_by_default' => 'boolean',
        'shared' => 'boolean',
    ];

    public function serverAccount()
    {
        return $this->belongsTo(ServerAccount::class);
    }
}
