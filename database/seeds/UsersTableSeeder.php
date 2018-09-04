<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'login' => 'bob',
                'password' => '123',
                'role' => 'admin',
                'firstname' => 'Bob',
                'lastname' => 'Sull',
                'email' => 'bob@sull.com',
                'langue' => 'fr',
            ],
            [
                'login' => 'fred',
                'password' => '123',
                'role' => 'membre',
                'firstname' => 'Fred',
                'lastname' => 'Sull',
                'email' => 'fred@sull.com',
                'langue' => 'en',
            ],
        ];

        foreach ($users as $record) {
            $user = new User;
            $user->login = $record['login'];
            $user->password = bcrypt($record['password']);
            $user->role()->associate(Role::where("role", $record['role'])->firstOrFail());
            $user->firstname = $record['firstname'];
            $user->lastname = $record['lastname'];
            $user->email = $record['email'];
            $user->langue = $record['langue'];
            $user->save();
        }
    }
}
