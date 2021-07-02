<?php

namespace App\Providers;

use App\Models\{
    Category,
    Client,
    Plan,
    Product,
    Tables,
    Tenant
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    PlanObserver,
    ProductObserver,
    TableObserver,
    TenantObserver
};
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Client::observe(ClientObserver::class);
        Tables::observe(TableObserver::class);
    }
}
