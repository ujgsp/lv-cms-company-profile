<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $guarded = ['id'];

    // query scope
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan search
        $query->when($filters['query'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        // Filter berdasarkan location
        $query->when($filters['location'] ?? false, function ($query, $location) {
            if ($location === 'all' || $location === '') {
                // Abaikan filter lokasi
                return $query;
            }
            // Jika lokasi bukan 'all' atau kosong, terapkan filter lokasi
            return $query->where('location', $location);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
