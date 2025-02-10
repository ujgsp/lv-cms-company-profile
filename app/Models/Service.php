<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
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
