<?php

namespace App\MoonShine\Resources;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class FeatureResource extends Resource
{
	public static string $model = Feature::class;

	public static string $title = 'Особливості';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make("Назва", 'title')->required(),
            Text::make("Опис", 'desc')->required(),
            Text::make("Шлях до іконки", 'icon')->required(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'title'=>['required'],
            'desc'=>['required'],
            'icon'=>['required'],
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
