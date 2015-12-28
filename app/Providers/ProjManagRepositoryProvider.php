<?php

namespace ProjManag\Providers;

use Illuminate\Support\ServiceProvider;

class ProjManagRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(\ProjManag\Repositories\ClientRepository::class,\ProjManag\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\ProjManag\Repositories\ProjectRepository::class,\ProjManag\Repositories\ProjectRepositoryEloquent::class);
        $this->app->bind(\ProjManag\Repositories\ProjectNoteRepository::class,\ProjManag\Repositories\ProjectNoteRepositoryEloquent::class);
        $this->app->bind(\ProjManag\Repositories\ProjectTaskRepository::class,\ProjManag\Repositories\ProjectTaskRepositoryEloquent::class);
    }
}
