<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \ProjManag\Client::truncate();
        factory(\ProjManag\Client::class,10)->create();
    }
}
