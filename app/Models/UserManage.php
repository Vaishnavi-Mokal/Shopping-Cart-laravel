<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class UserManage extends Model 
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'status',
        'role',
    ];


    public function getJWTIdentifier(){
        return $this->getKey();
        }
    
    public function getJWTCustomClaims(){
        return [];
    }


}
