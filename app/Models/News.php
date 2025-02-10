<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // membuat relasi dengan categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // query scope
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan search
        $query->when($filters['query'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });
    }
}
