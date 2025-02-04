<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'tld',
        'status',
        'registration_date',
        'expiration_date',
        'auth_info',
        'registrant_contact_id',
        'technical_contact_id',
        'admin_contact_id',
        'billing_contact_id',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
        'expiration_date' => 'datetime',
    ];

    /**
     * Get the registrant contact for the domain
     */
    public function registrantContact()
    {
        return $this->belongsTo(Contact::class, 'registrant_contact_id');
    }

    /**
     * Get the technical contact for the domain
     */
    public function technicalContact()
    {
        return $this->belongsTo(Contact::class, 'technical_contact_id');
    }

    /**
     * Get the admin contact for the domain
     */
    public function adminContact()
    {
        return $this->belongsTo(Contact::class, 'admin_contact_id');
    }

    /**
     * Get the billing contact for the domain
     */
    public function billingContact()
    {
        return $this->belongsTo(Contact::class, 'billing_contact_id');
    }

    /**
     * Get the full domain name (name + tld)
     */
    public function getFullDomainAttribute()
    {
        return "{$this->name}.{$this->tld}";
    }
}
