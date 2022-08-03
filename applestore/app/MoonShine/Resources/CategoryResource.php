<?php

namespace App\MoonShine\Resources;

use App\Models\Category;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Dashboard\DashboardBlock;
use Leeto\MoonShine\Fields\HasMany;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Metrics\ValueMetric;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class CategoryResource extends Resource
{
	public static string $model = Category::class;

	public static string $title = 'Категорії';

    public string $titleField = 'name';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make("Назва", 'title')->required(),
            Text::make("Опис", 'description')->required(),
            Text::make("Шлях до картинки", 'img')->required(),
            Text::make("Адреса", 'alias')->required(),

        ];


	}

	public function rules(Model $item): array
	{
	    return [
            'title' => ['required'],
            'description' => ['required'],
            'img' => ['required'],
            'alias' => ['required'],
        ];
    }

    public function search(): array
    {
        return ['id', 'title'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [];
    }
}
