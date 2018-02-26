<?php

namespace App\Providers;

use Acacha\User\GuestUser;
use App\InvitationCodeGenerator;
use App\InvitationCodeGeneratorComplex;
use App\InvitationCodeGeneratorSimple;
use App\Observer\TaskObserver;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('*', function ($view) {
        if (Auth::user()) {
          $view->with('user', Auth::user());
        } else {
          $view->with('user', new GuestUser);
        }
      });

      Task::observe(TaskObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind(InvitationCodeGenerator::class, function () {
          if (config('codes.type') == 'simple') {
            return new InvitationCodeGeneratorSimple();
          } else if (config('codes.type') == 'complex') {
            return new InvitationCodeGeneratorComplex();
          } else {
            dd('Error');
          }
        });
    }
}
