<?php

use App\Groups;
use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = Groups::pluck('id')->toArray();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 1000; $i++) {
            App\Resource::create([
                'group_id' => $faker->randomElement($userIds),
                'name' => $faker->name
            ]);
        }
    }
}
