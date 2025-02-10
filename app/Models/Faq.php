<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the category that owns the FAQ.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
