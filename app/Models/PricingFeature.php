<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingFeature extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pricing_package_features';

    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }
}
