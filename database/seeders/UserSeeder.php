<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();

        $users = array(
            ['name' => 'Anna Beatriz', 'email' => 'annabeatriz@gmail.com', 'password' => Hash::make('123'), 'api_token' => Hash::make('123')],
            ['name' => 'Robson Nunes', 'email' => 'robsonnuens@gmail.com', 'password' => Hash::make('123'), 'api_token' => Hash::make('123')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
