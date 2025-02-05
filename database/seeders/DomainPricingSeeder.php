<?php

namespace Database\Seeders;

use App\Models\DomainPricing;
use Illuminate\Database\Seeder;

class DomainPricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tlds = [
            [
                'tld' => 'rw',
                'register_price' => '16000',
                'renew_price' => '18000',
                'transfer_price' => '0',
                'grace_period' => '5',
                'redemption_period' => '6',
                'min_years' => '1',
                'max_years' => '10',
                'status' => 'available',
            ],
            [
                'tld' => 'ac.rw',
                'register_price' => '16000',
                'renew_price' => '18000',
                'transfer_price' => '0',
                'grace_period' => '5',
                'redemption_period' => '6',
                'min_years' => '1',
                'max_years' => '10',
                'status' => 'available',
            ],
            [
                'tld' => 'org.rw',
                'register_price' => '16000',
                'renew_price' => '18000',
                'transfer_price' => '0',
                'grace_period' => '5',
                'redemption_period' => '6',
                'min_years' => '1',
                'max_years' => '10',
                'status' => 'available',
            ],
            [
                'tld' => 'co.rw',
                'register_price' => '16000',
                'renew_price' => '18000',
                'transfer_price' => '0',
                'grace_period' => '5',
                'redemption_period' => '6',
                'min_years' => '1',
                'max_years' => '10',
                'status' => 'available',
            ],
            [
                'tld' => 'rw',
                'register_price' => '16000',
                'renew_price' => '18000',
                'transfer_price' => '0',
                'grace_period' => '5',
                'redemption_period' => '6',
                'min_years' => '1',
                'max_years' => '10',
                'status' => 'available',
            ],
            [
                'tld' => 'net.rw',
                'register_price' => '16000',
                'renew_price' => '18000',
                'transfer_price' => '0',
                'grace_period' => '5',
                'redemption_period' => '6',
                'min_years' => '1',
                'max_years' => '10',
                'status' => 'available',
            ],

        ];

        DomainPricing::insert($tlds);
    }
}
