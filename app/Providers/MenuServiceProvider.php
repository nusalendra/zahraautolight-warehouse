<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $verticalMenuOwnerJson = file_get_contents(base_path('resources/menu/verticalMenuOwner.json'));
    $verticalMenuOwnerData = json_decode($verticalMenuOwnerJson);

    $verticalMenuAdminJson = file_get_contents(base_path('resources/menu/verticalMenuAdmin.json'));

    $verticalMenuAdminData = json_decode($verticalMenuAdminJson);

    // Share all menuData to all the views
    $this->app->make('view')->share('menuOwnerData', [$verticalMenuOwnerData]);
    $this->app->make('view')->share('menuAdminData', [$verticalMenuAdminData]);
  }
}
