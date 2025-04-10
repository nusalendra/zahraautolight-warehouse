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
    $verticalMenuAdminJson = file_get_contents(base_path('resources/menu/verticalMenuAdmin.json'));
    $verticalMenuAdminData = json_decode($verticalMenuAdminJson);

    $verticalMenuKaryawanJson = file_get_contents(base_path('resources/menu/verticalMenuKaryawan.json'));

    $verticalMenuKaryawanData = json_decode($verticalMenuKaryawanJson);

    // Share all menuData to all the views
    $this->app->make('view')->share('menuAdminData', [$verticalMenuAdminData]);
    $this->app->make('view')->share('menuKaryawanData', [$verticalMenuKaryawanData]);
  }
}
