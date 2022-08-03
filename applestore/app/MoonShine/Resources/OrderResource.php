<?php

namespace App\MoonShine\Resources;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

use Leeto\MoonShine\Fields\Date;
use Leeto\MoonShine\Fields\Email;
use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Fields\Phone;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Filters\TextFilter;
use Leeto\MoonShine\Metrics\LineChartMetric;
use Leeto\MoonShine\Metrics\ValueMetric;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\ID;

class OrderResource extends Resource
{
    public static string $model = Orders::class;

	public static string $title = 'Інфо. про людину';

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make("Ім'я", 'fname')->required(),
            Text::make('Прізвище', 'lname')->required(),
            Phone::make('Номер телефону', 'phone')->required(),
            Email::make('Електронна пошта', 'email')->required(),
            Text::make('Країна', 'country')->required(),
            Text::make('Місто', 'city')->required(),
            Text::make('Адреса', 'address')->required(),
            Text::make('Статус замовлення', 'status')->required(),
            Text::make('Повідомлення', 'message'),
            Text::make('ТТН', 'tracking_no')->readonly(),
            Date::make('Дата створення', 'created_at')->hideOnForm(),
        ];
    }

    public function metrics(): array
    {
        return [

            ValueMetric::make('Відсоток завершених замовлень')
                ->value(Orders::where('status', 1)->count())
                ->progress(Orders::count()),
            LineChartMetric::make('Кількість замволень')
                ->line([
                    'Замовлень' => Orders::query()
                        ->groupBy('created_at')
                        ->selectRaw('count(id) as amount, created_at')
                        ->pluck('amount','created_at')
                        ->mapWithKeys(fn($value, $key) => [date('d.m.Y', strtotime($key)) => $value])

                        ->toArray()
                ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'fname' => ['required'],
            'lname' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'country' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'status' => ['required'],
            'message' => [''],
            'tracking_no' => ['required'],

        ];
    }

    public function search(): array
    {
        return ['id','fname', 'lname', 'phone', 'email', 'country', 'city', 'address', 'status', 'message','tracking_no'];
    }

    public function filters(): array
    {
        return [
                TextFilter::make("Ім'я", 'fname'),
                TextFilter::make('Прізвище ', 'lname'),
                TextFilter::make('Номер телефону ', 'phone'),
                TextFilter::make('Електронна пошта ', 'email'),
                TextFilter::make('Країна ', 'country'),
                TextFilter::make('Місто', 'city'),
                TextFilter::make('Адреса ', 'address'),
                TextFilter::make('Статус замовлення ', 'status'),
                TextFilter::make('ТТН ', 'tracking_no'),

            ];
    }

    public function actions(): array
    {
        return [];
    }
}
