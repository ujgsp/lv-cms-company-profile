<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // query scope
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan search
        $query->when($filters['query'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });

        // Filter berdasarkan status
        $query->when($filters['status'] ?? false, function ($query, $status) {
            if ($status === 'all' || $status === '') {
                // Abaikan filter lokasi
                return $query;
            }
            // Jika lokasi bukan 'all' atau kosong, terapkan filter lokasi
            return $query->where('status', $status);
        });
    }
}
