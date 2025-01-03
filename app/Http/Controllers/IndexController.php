<?php


namespace App\Http\Controllers;

use App\Http\Enums\Training\TrainingMenu;
use App\Http\Enums\Unit\UnitType;
use App\Models\Book;
use App\Models\Money;
use App\Models\Training;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
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
        $isTrained = Training::query()
            ->whereBetween('created_at', [
                $startToday->format('Y-m-d H:i:s'),
                $endToday->format('Y-m-d H:i:s')
            ])
            ->exists();
        $isRead = Book::query()
            ->whereBetween('created_at', [
                $startToday->format('Y-m-d H:i:s'),
                $endToday->format('Y-m-d H:i:s')
            ])
            ->exists();
        return Inertia::render(
            'Index',
            [
                'selectItems' => [
                    'trainingMenu' => TrainingMenu::getSelectItems(),
                    'unitType' => UnitType::getSelectItems()
                ],
                'isTrained' => $isTrained,
                'isRead' => $isRead
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
            Book::query()->create(
                $request['alcohol']
            );
        }

        $request->session()->flash('message', '登録しました。');

        return redirect('');
    }
}
