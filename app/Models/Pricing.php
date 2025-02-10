<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pricing_packages';

    public function pricingFeatures()
    {
        return $this->hasMany(PricingFeature::class, 'pricing_package_id');
    }
}
