<?php

use App\Artist;
use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = [
            ['firstname' => 'Bob', 'lastname' => 'Sull'],
            ['firstname' => 'Marc', 'lastname' => 'Flynn'],
            ['firstname' => 'Fred', 'lastname' => 'Durand'],
        ];
        foreach ($artists as $artist) {
            Artist::create($artist);
        }
    }
}
