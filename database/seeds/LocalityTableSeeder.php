<?php

use Illuminate\Database\Seeder;

class LocalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localities = [
            ['postal_code' => '1000', 'locality' => 'Bruxelles'],
            ['postal_code' => '4000', 'locality' => 'Liege'],
            ['postal_code' => '2000', 'locality' => 'Anvers'],
        ];
        foreach ($localities as $l) {
            DB::table('localities')->insert([
                'postal_code' => $l['postal_code'],
                'locality' => $l['locality'],
            ]);
        }
    }
}
