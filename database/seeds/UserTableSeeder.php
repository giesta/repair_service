<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name' => 'Chris Sevilleja',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test'),
        ));
    }
}
