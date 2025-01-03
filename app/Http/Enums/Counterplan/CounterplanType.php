<?php


namespace App\Http\Enums\Counterplan;

/**
 * Class CounterplanType
 * @package App\Http\Enums\Counterplan
 */
class CounterplanType
{
    const OTHER_DRINK = '他の飲み物で対応';

    static function getSelectItems()
    {
        return [
            [
                'value' => self::OTHER_DRINK,
                'text' => self::OTHER_DRINK
            ],
        ];
    }
}
