<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ArtistsTableSeeder::class,
            TypeTableSeeder::class,
            RoleTableSeeder::class,
            LocalityTableSeeder::class,
            LocationsTableSeeder::class,
            ShowTableSeeder::class,
            RepresentationTableSeeder::class,
            ArtistTypeTableSeeder::class,
            CollaborationSeeder::class,
            UsersTableSeeder::class,
            ReservationsTableSeeder::class
        ]);
    }
}
