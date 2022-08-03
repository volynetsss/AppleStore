<?php

namespace App\MoonShine\Resources;

use App\Models\Information;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Fields\Email;
use Leeto\MoonShine\Fields\Phone;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class InformationResource extends Resource
{
	public static string $model = Information::class;

	public static string $title = 'Контакти';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make("Назва", 'title')->required(),
            Phone::make("Номер телефону", 'phone')->required(),
            Email::make("Електронна пошта", 'email')->required(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'title' => ['required'],
            'phone' => ['required'],
            'email' => ['required']
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
