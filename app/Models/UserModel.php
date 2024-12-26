<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Authenticatable 
{
    use HasFactory;
	use SoftDeletes; 
	protected $table = 'users'; 
    protected $fillable = ['id','type','name','email','email_verified_at','password','visible_password'];
}
