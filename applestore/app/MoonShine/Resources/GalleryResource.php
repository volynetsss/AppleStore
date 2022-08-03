<?php

namespace App\MoonShine\Resources;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class GalleryResource extends Resource
{
	public static string $model = Gallery::class;

	public static string $title = 'Галерея';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make("Назва", 'title')->required(),
            Text::make("Опис", 'desc')->required(),
            Text::make("Шлях до картинки", 'img')->required(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'title'=>['required'],
            'desc'=>['required'],
            'img'=>['required'],
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
