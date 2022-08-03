<?php

namespace App\MoonShine;

use App\Models\Category;
use App\Models\Orders;
use App\Models\Product;
use Leeto\MoonShine\Dashboard\DashboardBlock;
use Leeto\MoonShine\Dashboard\DashboardScreen;
use Leeto\MoonShine\Metrics\ValueMetric;

class Dashboard extends DashboardScreen
{
	public function blocks(): array
	{
		return [
            DashboardBlock::make([
                ValueMetric::make('Кількість категорій')
                    ->value(Category::query()->count())
            ]),
            DashboardBlock::make([
                ValueMetric::make('Кількість товарів')
                    ->value(Product::query()->count())
            ]),
            DashboardBlock::make([
                ValueMetric::make('Кількість замовлень')
                    ->value(Orders::query()->count())
            ])
        ];
	}
}
