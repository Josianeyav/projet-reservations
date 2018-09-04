<?php

use App\Artist;
use App\ArtisteType;
use App\Type;
use Illuminate\Database\Seeder;

class ArtistTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artistTypes = [
            [
                'artist' => ['firstname' => 'Bob', 'lastname' => 'Sull'],
                'type' => 'scènographe',
            ],
            [
                'artist' => ['firstname' => 'Bob', 'lastname' => 'Sull'],
                'type' => 'comédien',
            ],
            [
                'artist' => ['firstname' => 'Marc', 'lastname' => 'Flynn'],
                'type' => 'comédien',
            ],
            [
                'artist' => ['firstname' => 'Fred', 'lastname' => 'Durand'],
                'type' => 'décorateur',
            ],
            [
                'artist' => ['firstname' => 'Marc', 'lastname' => 'Flynn'],
                'type' => 'scènographe'
            ],
            [
                'artist' => ['firstname' => 'Marc', 'lastname' => 'Flynn'],
                'type' => 'comédien',
            ]
        ];

        foreach ($artistTypes as $artistType) {
            $artistInfo = $artistType['artist'];

            $type = Type::where("type", $artistType['type'])->firstOrFail();
            $artist = Artist::where("firstname", $artistInfo['firstname'])
                ->where('lastname', $artistInfo['lastname'])
                ->firstOrFail();

            $artistType = new ArtisteType;
            $artistType->artist()->associate($artist);
            $artistType->type()->associate($type);
            $artistType->save();
        }
    }
}
