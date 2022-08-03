<?php

namespace App\MoonShine\Resources;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Fields\BelongsTo;
use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Filters\TextFilter;
use Leeto\MoonShine\Metrics\ValueMetric;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class ProductResource extends Resource
{
	public static string $model = Product::class;

	public static string $title = 'Товари';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make('Назва', 'title')->required(),
            Text::make('Ціна', 'price')->required(),
            Text::make('В наявності', 'in_stock')->required(),
            Text::make('Опис', 'description')->required(),
            Text::make('Нова ціна', 'new_price')->nullable(),
            Number::make('ID категорії', 'category_id')->required(),
            Text::make('Адреса продукту', 'alias')->required(),
            Text::make('Колір', 'color')->required(),
        ];
	}

    public function metrics(): array
    {
        return [
            ValueMetric::make('Відсоток наявних товарів')
                ->value(Product::where('in_stock', 1)->count())
                ->progress(Product::count())
        ];
    }

    public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('ID категорії', 'category_id'),

        ];
    }

    public function actions(): array
    {
        return [];
    }
}
