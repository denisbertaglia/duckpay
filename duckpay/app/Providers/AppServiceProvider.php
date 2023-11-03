<?php

namespace App\Providers;

use App\Application\User\UserSevice;
use App\Domain\User\UserRepository;
use App\Infrastructure\DB;
use App\Infrastructure\User\PdoUserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use \PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PDO::class, function(Application $app){
            return DB::createConnection(env('DB_DATABASE'));
        });
        $this->app->bind(UserRepository::class, fn (Application $app) => new PdoUserRepository($app->make(PDO::class)));
        $this->app->bind(UserSevice::class, fn (Application $app) => new UserSevice($app->make(UserRepository::class)));

//        $this->app->bind(UserRepository::class, function(Application $app){
//            new PdoUserRepository($app->make(PDO::class));
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
