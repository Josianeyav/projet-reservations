<?php

use App\Representation;
use App\Reservation;
use App\User;
use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservations = [
            [
                'representation' => 'ayiti-201810121330',
                'user' => 'bob',
                'places' => 2,
            ],
            [
                'representation' => 'cible-mouvante-201810142030',
                'user' => 'bob',
                'places' => 1,
            ],
            [
                'representation' => 'ayiti-201810121330',
                'user' => 'fred',
                'places' => 1,
            ],
        ];

        foreach ($reservations as $record) {
            $representation = Representation::where("ref", $record['representation'])->firstOrFail();
            $user = User::where("login", $record['user'])->firstOrFail();

            $reservation = new Reservation;
            $reservation->representation()->associate($representation);
            $reservation->user()->associate($user);
            $reservation->places = $record['places'];
            $reservation->save();
        }
    }
}
