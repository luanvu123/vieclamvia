<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Info;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\Product;
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
        $layout_info = Info::first();
        $layout_customer = Customer::count();
        $layout_order = Order::count();
        $layout_order_detail = OrderDetail::count();
        $layout_post = Post::count();
        $layout_product = Product::count();

        View::share([
            'layout_categories' => $layout_categories,
            'layout_subcategories' => $layout_subcategories,
            'layout_info' => $layout_info,
            'layout_customer' => $layout_customer,
            'layout_order' => $layout_order,
            'layout_order_detail' => $layout_order_detail,
            'layout_post'=>$layout_post,
            'layout_product' => $layout_product,
        ]);
    }
}
