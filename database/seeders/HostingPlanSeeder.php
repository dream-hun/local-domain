<?php

namespace Database\Seeders;

use App\Models\HostingPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HostingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'uuid' => Str::uuid(),
                'name' => 'Bronze',
                'slug' => 'bronze',
                'monthly_price' => 5000,
                'yearly_price' => 40000,
                'is_featured' => false,
                'type' => 'shared',
                'status' => 'active',
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'White',
                'slug' => 'white',
                'monthly_price' => 10000,
                'yearly_price' => 65000,
                'is_featured' => false,
                'type' => 'shared',
                'status' => 'active',
            ],
            ['uuid' => Str::uuid(),
                'name' => 'Gold',
                'slug' => 'gold',
                'monthly_price' => 15000,
                'yearly_price' => 100000,
                'is_featured' => true,
                'type' => 'shared',
                'status' => 'active',
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Gold Premium',
                'slug' => 'gold-premium',
                'monthly_price' => 25000,
                'yearly_price' => 250000,
                'is_featured' => false,
                'type' => 'shared',
                'status' => 'active',
            ],
        ];
        HostingPlan::insert($plans);
    }
}
