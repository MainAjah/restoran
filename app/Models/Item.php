<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Item extends Model
{
    use softDeletes, HasFactory;
    protected $fillable = [
        'item_name',
        'category_id',
        'image',
        'price',
        'description',
        'is_available',
    ];
    
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

