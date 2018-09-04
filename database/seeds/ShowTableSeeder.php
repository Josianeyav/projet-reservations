<?php

use App\Location;
use App\Show;
use Illuminate\Database\Seeder;

class ShowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shows = [
            [
                'slug' => 'ayiti',
                'title' => 'Ayiti',
                'poster_url' => 'images/poster.jpg',
                'location' => Location::where('slug', 'belfius-art-collection')->firstOrFail(),
                'bookable' => 1,
                'price' => 9.50,
            ],
            [
                'slug' => 'cible-mouvante',
                'title' => 'Cible Mouvante',
                'poster_url' => 'images/poster.jpg',
                'location' => Location::where('slug', 'la-samaritaine')->firstOrFail(),
                'bookable' => 1,
                'price' => 8.00,
            ],
            [
                'slug' => 'ceci-n-est-pas-chanteur-belge',
                'title' => 'Ceci n\'est pas un chanteur belge',
                'poster_url' => 'images/poster.jpg',
                'location' => Location::where('slug', 'belfius-art-collection')->firstOrFail(),
                'bookable' => 0,
                'price' => 7.50,
            ],
        ];
        foreach ($shows as $record) {
            $show = new Show;
            $show->slug = $record["slug"];
            $show->title = $record["title"];
            $show->poster_url = $record["poster_url"];
            $show->bookable = $record["bookable"];
            $show->price = $record["price"];
            $show->location()->associate($record["location"]);
            $show->save();
        }
    }
}
