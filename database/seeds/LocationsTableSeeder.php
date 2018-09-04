<?php

use App\Locality;
use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bruxelles = Locality::where('locality', 'Bruxelles')->firstOrFail();
        $locations = [
            [
                'slug' => 'belfius-art-collection',
                'designation' => 'Belfius Art Collection',
                'address' => '50 rue de l\'Écuyer',
                'locality' => $bruxelles,
                'website' => null,
                'phone' => null,
            ],
            [
                'slug' => 'la-samaritaine',
                'designation' => 'La Samaritaine',
                'address' => 'rue de la samaritaine',
                'locality' => $bruxelles,
                'website' => 'www.lasamaritaine.be',
                'phone' => '02/511.33.95',
            ],
            [
                'slug' => 'theatre-royal-parc',
                'designation' => 'Théâtre Royal du Parc',
                'address' => 'Rue de la Loi 3',
                'locality' => $bruxelles,
                'website' => 'www.theatreduparc.be',
                'phone' => null,
            ],
        ];
        foreach ($locations as $record) {
            $location = new Location;
            $location->slug = $record["slug"];
            $location->designation = $record["designation"];
            $location->address = $record["address"];
            $location->website = $record["website"];
            $location->phone = $record["phone"];
            $location->locality()->associate($record["locality"]);
            $location->save();
        }
    }
}
