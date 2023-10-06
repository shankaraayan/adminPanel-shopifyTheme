<?php

namespace App\Providers;

use App\Models\Categories;
use App\Models\subCategories;
use App\Models\announcementBar;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		Paginator::useBootstrap();
		
		view()->composer(
            'layouts.app', 
            function ($view) {
                $view->with('data', ['categories' => Categories::orderBy('category','asc')->get(), 'subCategories' => subCategories::orderBy('subCategory','asc')->get(), 'announcement' => announcementBar::get()]);
            }
        );
    }
}
