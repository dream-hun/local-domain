<?php

namespace Database\Seeders;

use App\Models\HostingFeature;
use Illuminate\Database\Seeder;

class HostingPlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'hosting_plan_id' => 1,
                'name' => '2GB Webspace',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 1,
                'name' => 'Unlimited Bandwidth',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 1,
                'name' => '5 Mail Account',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 1,
                'name' => '10 MySQL Database',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 1,
                'name' => '10 Subdomain',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 1,
                'name' => 'Addon Website builder',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 2,
                'name' => '5GB Webspace',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 2,
                'name' => 'Unlimited Bandwidth',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 2,
                'name' => '30 Mail Account',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 2,
                'name' => '30 MySQL Database',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 2,
                'name' => '30 Subdomain',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 2,
                'name' => 'Addon Website builder',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 3,
                'name' => '10GB Webspace',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 3,
                'name' => 'Unlimited Bandwidth',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 3,
                'name' => '20 Mail Account',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 3,
                'name' => '30 MySQL Database',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 3,
                'name' => '30 Subdomain',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 3,
                'name' => 'Addon Website builder',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 4,
                'name' => '20GB Webspace',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 4,
                'name' => 'Unlimited Bandwidth',
                'is_enabled' => true,
            ],
            [
                'hosting_plan_id' => 4,
                'name' => '30 Mail Account',
                'is_enabled' => true,

            ],

        ];
        HostingFeature::insert($features);
    }
}
