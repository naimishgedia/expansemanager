<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExpanseCategory extends Model
{  
	use HasFactory; 
	use SoftDeletes;  
	protected $table = 'user_expanse_category';  
    protected $fillable = ['id','user_id','category_name','category_icon','created_at','updated_at','deleted_at'];  
}
