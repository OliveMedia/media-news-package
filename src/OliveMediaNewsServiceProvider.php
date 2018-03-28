<?php

namespace OliveMedia\OliveMediaNews;

use Illuminate\Support\ServiceProvider;

class OliveMediaNewsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->mergeConfigFrom(__DIR__ . '/config/olivemedianews.php', 'media-news-package');
        
        require __DIR__.'/Routes/routes.php';

        //loading views
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'media-news-package');

        //publishing database file
        $this->publishDatabases();

        //publishing views file
        $this->publishViews();

        //publishing middelware file
        $this->publishMiddlewares();

        // publishing config
        $this->publishConfigs();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //loading migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');


        //bind the news repo
        $this->app->bind(
            'OliveMedia\OliveMediaNews\Persistence\Repositories\Contract\NewsInterface',
            'OliveMedia\OliveMediaNews\Persistence\Repositories\Eloquent\NewsRepository'
        );
    }

    /**
    * Publishes Database related class to main application
    * @includes database migrations
    * @includes database seeder
    * @includes database factory
    */

    public function publishDatabases()
    {
        //migration
        $this->publishes([
            __DIR__.'/Database/Migrations' => base_path('database/migrations')
        ], 'migrations');

        //seeder
        /*$this->publishes([
            __DIR__.'/Database/Seeds' => base_path('database/seeds')
        ]);*/

        //database factory
         /*$this->publishes([
            __DIR__.'/Database/Factories' => base_path('database/factories')
         ]);*/
    }

    /**
    * Publishes views related file to main application
    * @includes usermodule views
    */

    public function publishViews()
    {
        $this->publishes([
            __DIR__.'/Resources/views' => base_path('resources/views/vendor/news')
        ], 'views');
    }

    /**
    * Publishes views related file to main application
    * @includes usermodule views
    */

    public function publishMiddlewares()
    {
         //middleware publish
        $this->publishes([
            __DIR__.'/Http/Middleware' => base_path('app/Http/Middleware')
        ]);
    }

    public function publishConfigs()
    {
        //config publish
        $this->publishes([
            __DIR__.'/config/olivemedianews.php' => config_path('olivemedianews.php')
        ], 'config');
    }

}
