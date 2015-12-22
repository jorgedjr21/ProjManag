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
        \ProjManag\Models\Client::truncate();
        factory(\ProjManag\Models\Client::class,10)->create();
    }
}
