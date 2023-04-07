<?php

namespace Dolati\Uploader;


use Illuminate\Support\ServiceProvider;
use Dolati\Uploader\Middleware\CheckAccess;

class UploaderServiceProvider extends ServiceProvider
{

    public function register()
    {

        // $this->app->bind('uploader' , function (){
        //     return new Uploader() ;
        // });
        $this->app->bind('uploader');

        $this->mergeConfigFrom(__DIR__ . '\config\uploader.php', 'uploader');
    }

    public function boot()
    {
        require __DIR__.'/api.php';
        // $this->loadViewsFrom(__DIR__ . '\views', 'uploader');

        // $this->app['router']->aliasMiddleware('checkAccess' , CheckAccess::class);

        $this->publishes([
            __DIR__ . '\config\uploader.php' => config_path('uploader.php') ,
            // __DIR__ . '\views' => base_path('resources/views/uploader') ,
            __DIR__ . '\Migrations' => database_path('migrations') ,
            __DIR__ . '\Requests' => base_path('app/Http/Requests') ,

        ]);
    }
}
