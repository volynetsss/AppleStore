<?php

namespace App\MoonShine\Resources;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Leeto\MoonShine\Fields\Date;
use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Fields\SlideField;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Filters\SlideFilter;
use Leeto\MoonShine\Filters\TextFilter;
use Leeto\MoonShine\Metrics\LineChartMetric;
use Leeto\MoonShine\Metrics\ValueMetric;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class OrderItemResource extends Resource
{
	public static string $model = OrderItems::class;

	public static string $title = 'Замовлені товари';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Number::make('ID замовлення', 'order_id'),
            Number::make('ID товару', 'product_id'),
            Number::make('Кількість', 'qty'),
            Text::make('Ціна', 'price'),
            Date::make('Дата створення', 'created_at')->hideOnForm(),

        ];
	}

    public function metrics(): array
    {
        return [
            LineChartMetric::make('Замовлення')
                ->line([
                    'Зароблено' => OrderItems::query()
                        ->groupBy('created_at')
                        ->selectRaw('SUM(price) as sum, created_at')
                        ->pluck('sum','created_at')
                        ->mapWithKeys(fn($value, $key) => [date('d.m.Y', strtotime($key)) => $value])

                        ->toArray()
                ]),
        ];
    }

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id', 'order_id', 'product_id'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('ID замовлення', 'order_id'),
            TextFilter::make('ID товару', 'product_id'),

        ];
    }

    public function actions(): array
    {
        return [];
    }
}
