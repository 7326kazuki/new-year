<?php


namespace App\Http\Enums\Counterplan;

/**
 * Class CounterplanType
 * @package App\Http\Enums\Counterplan
 */
class CounterplanType
{
    const COUNTERPLANS = [
        '他の飲み物で対応'
    ];

    static function getSelectItems()
    {
        return collect(self::COUNTERPLANS)
            ->map(
                function (string $menu) {
                    return [
                        'value' => $menu,
                        'text' => $menu
                    ];
                }
            );
    }
}
