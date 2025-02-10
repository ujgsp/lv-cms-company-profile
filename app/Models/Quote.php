<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the service that owns the quote.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // query scope
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan search
        $query->when($filters['query'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('company', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%');
        });
    }
}
