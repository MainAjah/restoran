<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'city',
        'phone',
        'email',
        'description',
        'is_active',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $store) {
            $store->slug ??= Str::slug($store->name);
        });

        static::updating(function (self $store) {
            if ($store->isDirty('name') && empty($store->slug)) {
                $store->slug = Str::slug($store->name);
            }
        });
    }
}
