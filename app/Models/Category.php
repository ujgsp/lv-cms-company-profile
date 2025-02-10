<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

        // Filter berdasarkan type
        $query->when($filters['type'] ?? false, function ($query, $type) {
            if ($type === 'all' || $type === '') {
                // Abaikan filter lokasi
                return $query;
            }
            // Jika lokasi bukan 'all' atau kosong, terapkan filter lokasi
            return $query->where('type', $type);
        });
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'category_project');
    }

    /**
     * Get the FAQs for the category.
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

}
