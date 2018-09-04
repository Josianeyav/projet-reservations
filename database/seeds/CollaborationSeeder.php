<?php

use App\Artist;
use App\ArtisteType;
use App\Collaboration;
use App\Show;
use App\Type;
use Illuminate\Database\Seeder;

class CollaborationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collaborations = [
            [
                'artist' => ['firstname' => 'Bob', 'lastname' => 'Sull'],
                'type' => 'scènographe',
                'show' => 'ayiti',
            ],
            [
                'artist' => ['firstname' => 'Bob', 'lastname' => 'Sull'],
                'type' => 'comédien',
                'show' => 'ayiti',
            ],
            [
                'artist' => ['firstname' => 'Marc', 'lastname' => 'Flynn'],
                'type' => 'comédien',
                'show' => 'ayiti',
            ],
            [
                'artist' => ['firstname' => 'Fred', 'lastname' => 'Durand'],
                'type' => 'décorateur',
                'show' => 'ayiti',
            ],
            [
                'artist' => ['firstname' => 'Marc', 'lastname' => 'Flynn'],
                'type' => 'scènographe',
                'show' => 'cible-mouvante',
            ],
            [
                'artist' => ['firstname' => 'Marc', 'lastname' => 'Flynn'],
                'type' => 'comédien',
                'show' => 'cible-mouvante',
            ],
        ];

        foreach ($collaborations as $collaboration) {

            $artist = $collaboration['artist'];
            $artistModel = Artist::where("firstname", $artist['firstname'])
                ->where('lastname', $artist['lastname'])
                ->firstOrFail();

            $type = Type::where('type', $collaboration['type'])->firstOrFail();


            $artistType = ArtisteType::where("artist_id", $artistModel->id)
                ->where('type_id', $type->id)
                ->firstOrFail();
            $show = Show::where("slug", $collaboration['show'])->firstOrFail();

            $collaboration = new Collaboration;
            $collaboration->show()->associate($show);
            $collaboration->artisteType()->associate($artistType);
            $collaboration->save();
        }
    }
}
