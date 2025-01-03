<?php


namespace App\Http\Controllers;

use App\Http\Enums\Counterplan\CounterplanType;
use App\Http\Enums\Training\TrainingMenu;
use App\Http\Enums\Unit\UnitType;
use App\Models\Alcohol;
use App\Models\Book;
use App\Models\Money;
use App\Models\Training;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    public function index()
    {
        $startToday = CarbonImmutable::today()->startOfDay()->addHours(5);
        $endToday = $startToday->addDay();
        $trainings = Training::query()
            ->whereBetween('created_at', [
                $startToday->format('Y-m-d H:i:s'),
                $endToday->format('Y-m-d H:i:s')
            ])
            ->get()
            ->groupBy('menu')
            ->map(
                function (Collection $trainings, $key) {
                    /** @var Training $training */
                    $training = $trainings->first();
                    return [
                        'menu' => $key,
                        'times' => $trainings->sum('times') . $training->unit
                    ];
                }
            )->values();
        $books = Book::query()
            ->whereBetween('created_at', [
                $startToday->format('Y-m-d H:i:s'),
                $endToday->format('Y-m-d H:i:s')
            ])
            ->get()
            ->unique('name');
        $alcohols = Alcohol::query()
            ->whereBetween('created_at', [
                $startToday->format('Y-m-d H:i:s'),
                $endToday->format('Y-m-d H:i:s')
            ])
            ->get()
            ->groupBy('counterplan')
            ->map(
                function (Collection $alcohols, $key) {
                    /** @var Alcohol $alcohol */
                    $alcohol = $alcohols->first();
                    return [
                        'counterplan' => $key,
                        'times' => $alcohols->count() . '回'
                    ];
                }
            )->values();
        $totalPrice = Money::query()
            ->where('type', '食費')
            ->whereBetween('created_at', [
                $startToday->format('Y-m-d H:i:s'),
                $endToday->format('Y-m-d H:i:s')
            ])
            ->get()
            ->sum('price');
        return Inertia::render(
            'Index',
            [
                'selectItems' => [
                    'trainingMenu' => TrainingMenu::getSelectItems(),
                    'unitType' => UnitType::getSelectItems(),
                    'counterplanType' => CounterplanType::getSelectItems()
                ],
                'trainings' => $trainings,
                'books' => $books,
                'alcohols' => $alcohols,
                'totalPrice' => $totalPrice
            ]
        );
    }

    public function post(Request $request)
    {
        if ($request->get('requestType') === 'training') {
            Training::query()->create(
                $request['training']
            );
        }
        if ($request->get('requestType') === 'book') {
            Book::query()->create(
                $request['book']
            );
        }
        if ($request->get('requestType') === 'money') {
            Money::query()->create(
                $request['money']
            );
        }
        if ($request->get('requestType') === 'alcohol') {
            Alcohol::query()->create(
                $request['alcohol']
            );
        }

        $request->session()->flash('message', '登録しました。');

        return redirect('');
    }
}
