<?php

namespace App\Providers;


use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


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
        view()->composer('*', function ($view)
        {
            $orderId = session('orderId');
            if (!is_null($orderId)) {
                $order = Order::findOrFail($orderId);
            }else{
                $order = false;
            }
            $categories = Category::where('parent_id',0)->get();

            $user = Auth::user();
            $view->with('user', $user);
            $view->with('categories', $categories);
            $view->with('order', $order);
        });
    }
}
