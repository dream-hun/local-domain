<?php

namespace App\Models;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DomainPricing extends Model
{
    protected $casts = [
        'register_price' => 'integer',
        'renew_price' => 'integer',
        'transfer_price' => 'integer',
        'redemption_period' => 'integer',
        'min_years' => 'integer',
        'max_years' => 'integer',

    ];

    protected $fillable = [
        'status',
        'max_years',
        'min_years',
        'redemption_period',
        'grace_period',
        'transfer_price',
        'renew_price',
        'register_price',
        'tld',
    ];

    public function registrationPrice(): Money
    {
        return Money::RWF($this->register_price);
    }

    public function renewalPrice(): Money
    {
        return Money::RWF($this->renew_price);
    }

    public function transferPrice(): Money
    {
        return Money::RWF($this->transfer_price);
    }

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }
}
