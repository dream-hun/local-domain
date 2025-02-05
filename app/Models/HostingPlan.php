<?php

namespace App\Models;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class HostingPlan extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'is_featured',
        'monthly_price',
        'yearly_price',
        'status',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(HostingFeature::class,'hosting_plan_id');
    }

    public static function boot(): void
    {
        parent::boot();
        static::creating(function ($hostingPlan) {
            $hostingPlan->uuid = (string) Str::uuid();
            $hostingPlan->slug = Str::slug($hostingPlan->name);
        });
    }

    public function formatedMonthlyPrice(): Money
    {
        return Money::RWF($this->monthly_price);
    }

    public function formatedYearlyPrice(): Money
    {
        return Money::RWF($this->yearly_price);
    }
}
