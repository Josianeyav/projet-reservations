<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role'=>'Utilisateur'],
            ['role'=>'Admin'],
            ['role'=>'SuperAdmin'],
        ];

        foreach ($roles as $a) {
            DB::table('roles')->insert([
                'role' => $a['role'],
            ]);
        }
    }
}
