<?php


namespace App\Http\Enums\Unit;


class UnitType
{
    const MINUTE = '分';
    const TIMES = '回';

    static function getSelectItems()
    {
        return [
            [
                'value' => self::MINUTE,
                'text' => self::MINUTE
            ],
            [
                'value' => self::TIMES,
                'text' => self::TIMES
            ],
        ];
    }
}
