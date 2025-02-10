<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // membuat relasi dengan categories
    public function categories()
    {
        // return $this->belongsToMany(Category::class, 'category_project');
        return $this->belongsToMany(Category::class, 'category_project', 'project_id', 'category_id')
                ->withTimestamps();
    }

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
