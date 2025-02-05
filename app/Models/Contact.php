<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contact_id',
        'type',
        'names',
        'org',
        'street1',
        'street2',
        'street3',
        'city',
        'sp',
        'pc',
        'cc',
        'voice',
        'fax',
        'email',
        'password',
        'voice_disclosed',
        'email_disclosed',
    ];

    protected $casts = [
        'voice_disclosed' => 'boolean',
        'email_disclosed' => 'boolean',
    ];

    /**
     * Get the domains where this contact is the registrant
     */
    public function registrantDomains()
    {
        return $this->hasMany(Domain::class, 'registrant_contact_id');
    }

    /**
     * Get the domains where this contact is the technical contact
     */
    public function technicalDomains()
    {
        return $this->hasMany(Domain::class, 'technical_contact_id');
    }

    /**
     * Get the domains where this contact is the admin contact
     */
    public function adminDomains()
    {
        return $this->hasMany(Domain::class, 'admin_contact_id');
    }

    /**
     * Get the domains where this contact is the billing contact
     */
    public function billingDomains()
    {
        return $this->hasMany(Domain::class, 'billing_contact_id');
    }
}
