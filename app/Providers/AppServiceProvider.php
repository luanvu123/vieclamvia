<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         $layout_categories = Category::where('status', 'active')->get();
        $layout_subcategories = Subcategory::where('status', 'active')->get();

        View::share([
            'layout_categories' => $layout_categories,
            'layout_subcategories' => $layout_subcategories,
        ]);
    }
}
