<?php

use App\IncidentManagement;
use Faker\Factory;
use Illuminate\Database\Seeder;

class IncidentManagementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncidentManagement::truncate();
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            IncidentManagement::create([
                'title' => $faker->sentence,
                'category' => $faker->numberBetween($min = 1, $max = 3),
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'comments' => $faker->paragraph,
                'people' => $faker->text,
                'incidentDate' => $faker->dateTime,
                'createDate' => $faker->dateTime,
                'modifyDate' => $faker->dateTime,
            ]);
        }
    }
}
