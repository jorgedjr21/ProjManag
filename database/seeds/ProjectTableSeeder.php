<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(\ProjManag\Entities\Project::class,10)->create();
        DB::table('projects')->insert([
            'owner_id'      => 11,
            'client_id'     => rand(1,10),
            'name'          => 'Projeto 11',
            'description'   => 'Descrição do projeto 11.',
            'progress'      => rand(1,100),
            'status'        => rand(1,3),
            'due_date'      => '2016-03-05'
        ]);
    }
}
