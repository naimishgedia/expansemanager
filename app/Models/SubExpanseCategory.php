<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubExpanseCategory extends Model
{
   	use HasFactory; 
	use SoftDeletes;  
	protected $table = 'sub_expanse_category';  
    protected $fillable = ['id','user_id','exp_cat_id','subcategory_name','created_at','updated_at','deleted_at'];
}
