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
        \ProjManag\Entities\Client::truncate();
        factory(\ProjManag\Entities\Client::class,10)->create();
    }
}
