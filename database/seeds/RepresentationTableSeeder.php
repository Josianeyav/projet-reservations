<?php

use App\Location;
use App\Show;
use Illuminate\Database\Seeder;

class RepresentationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $representations = [
            [
                'ref' => 'ayiti-201810121330',
                'show' => 'ayiti',
                'location' => 'belfius-art-collection',
                'schedule' => new \DateTime('2018-10-12 13:30:00'),
            ],
            [
                'ref' => 'ayiti-201810122030',
                'show' => 'ayiti',
                'location' => 'theatre-royal-parc',
                'schedule' => new \DateTime('2018-10-12 20:30:00'),
            ],
            [
                'ref' => 'cible-mouvante-201810122030',
                'show' => 'cible-mouvante',
                'location' => null,
                'schedule' => new \DateTime('2018-10-12 20:30:00'),
            ],
            [
                'ref' => 'cible-mouvante-201810142030',
                'show' => 'cible-mouvante',
                'location' => null,
                'schedule' => new \DateTime('2018-10-14 20:30:00'),
            ],
            [
                'ref' => 'chanteur-belge-201810142030',
                'show' => 'ceci-n-est-pas-chanteur-belge',
                'location' => null,
                'schedule' => new \DateTime('2018-10-14 20:30:00'),
            ],
        ];

        foreach ($representations as $record) {
            $representation = new \App\Representation;
            $representation->schedule = $record["schedule"];
            $representation->ref = $record["ref"];

            $showModel = Show::where('slug', $record["show"])->firstOrFail();
            $representation->show()->associate($showModel);

            $location = $record['location'];
            if ($location) {
                $locationModel = Location::where('slug', $record["location"])->firstOrFail();
                $representation->location()->associate($locationModel);
            }

            $representation->save();
        }
    }
}
