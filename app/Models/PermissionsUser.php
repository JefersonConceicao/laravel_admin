<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsUser extends Model
{
    protected $table = 'permissions_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'permission_id',
    ];

    public function getPermissionsUser($userID){
        return $this
            ->where(['user_id' => $userID]);
    }
}


