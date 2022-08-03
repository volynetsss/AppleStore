<?php

namespace App\MoonShine\Resources;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Filters\TextFilter;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class ProductImageResource extends Resource
{
	public static string $model =  ProductImage::class;

	public static string $title = 'Картинки для товарів';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make('Шлях до картинки', 'img')->required(),
            Number::make('ID продукта ', 'product_id')->required(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id', 'product_id'];
    }

    public function filters(): array
    {
        return [TextFilter::make('ID продукта ', 'product_id'),];
    }

    public function actions(): array
    {
        return [];
    }
}
