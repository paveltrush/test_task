<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class ClientDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all the discounts
        $discounts = Discount::all();

        // Populate the pivot table
        Client::all()->each(function ($client) use ($discounts) {
            $client->discounts()->attach(
                $discounts->random(rand(1, 3))->pluck('id')->toArray(),
                ['date_activation' => now()]
            );
        });
    }
}
