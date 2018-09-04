<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['type' => 'décorateur'],
            ['type' => 'comédien'],
            ['type' => 'scènographe'],
        ];

        foreach ($types as $type) {
            DB::table('types')->insert([
                'type' => $type['type']
            ]);
        }
    }
}
