<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyExpanse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_expanse';

    protected $fillable = [
        'expanse_date',
        'amount',
        'category_id',
        'subcategory_id',
        'note',
        'description',
    ];

    /**
     * Relationship with the UserExpanseCategory model.
     */
    public function category()
    {
        return $this->belongsTo(UserExpanseCategory::class, 'category_id');
    }

    /**
     * Relationship with the SubExpanseCategory model.
     */
    public function subcategory()
    {
        return $this->belongsTo(SubExpanseCategory::class, 'subcategory_id');
    }
}
