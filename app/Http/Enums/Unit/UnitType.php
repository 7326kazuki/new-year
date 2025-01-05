<?php


namespace App\Http\Enums\Unit;


class UnitType
{
    const UNITS = [
        '分',
        '回'
    ];

    static function getSelectItems()
    {
        return collect(self::UNITS)
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
