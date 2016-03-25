<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\ProjManag\Entities\User::class, 10)->create();
        factory(\ProjManag\Entities\User::class)->create([
            'name' => 'Jorge',
            'email' => 'jorgedjr21@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
    }
}
