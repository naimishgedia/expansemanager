<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyExpanse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_expanse';
    protected $fillable = ['id', 'user_id', 'expanse_date', 'amount', 'category_id', 'subcategory_id', 'note', 'description', 'created_at', 'updated_at', 'deleted_at'];

    // Relationship with UserExpanseCategory (category)
    public function category()
    {
        return $this->belongsTo(UserExpanseCategory::class, 'category_id', 'id');
    }

    // Relationship with SubExpanseCategory (subcategory)
    public function subcategory()
    {
        return $this->belongsTo(SubExpanseCategory::class, 'subcategory_id', 'id');
    }
}
?>