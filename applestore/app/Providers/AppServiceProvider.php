<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\OrderItems;
use App\Models\Orders;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\FeatureResource;
use App\MoonShine\Resources\GalleryResource;
use App\MoonShine\Resources\InformationResource;
use App\MoonShine\Resources\OrderItemResource;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\ProductImageResource;
use App\MoonShine\Resources\ProductResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Leeto\MoonShine\Menu\MenuGroup;
use Leeto\MoonShine\Metrics\LineChartMetric;
use Leeto\MoonShine\MoonShine;
use Leeto\MoonShine\Resources\MoonShineUserResource;
use Leeto\MoonShine\Resources\MoonShineUserRoleResource;

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
        app(MoonShine::class)->registerResources([
            MenuGroup::make('Головна сторінка', [
                GalleryResource::class,
                FeatureResource::class,
            ]),
            MenuGroup::make('Конт. сторінка', [
                InformationResource::class,
            ])->icon('search') ,
            MenuGroup::make('Сторінка з прод.', [
                CategoryResource::class,
                ProductResource::class,
                ProductImageResource::class,
            ])->icon('bookmark') ,

            MenuGroup::make('Замовлення', [
                OrderResource::class,
                OrderItemResource::class,
            ])->icon('cart') ,

        ]);

        $trackingNo = Orders::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();

        View::share([
            'categories' => $categories,
            'trackingNo' => $trackingNo,
        ]);

    }
}
