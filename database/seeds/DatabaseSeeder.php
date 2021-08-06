<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingsTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            ProvinceTableSeeder::class,
            DistrictTableSeeder::class,
            CategorysTableSeeder::class,
            PostsTableSeeder::class,
            RealestateTableSeeder::class,
            RealestateSaveTableSeeder::class,
            SliderTableSeeder::class
        ]);
    }
}
