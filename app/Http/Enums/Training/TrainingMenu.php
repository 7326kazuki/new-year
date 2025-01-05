<?php


namespace App\Http\Enums\Training;

/**
 * Class TrainingMenu
 * @package App\Http\Enums\Training
 */
class TrainingMenu
{
    const MENUS = [
        '腕立て伏せ',
        'スクワット',
        '体幹',
        '倒立',
        'ストレッチ',
        'ジム',
        'ランニング'
    ];

    static function getSelectItems()
    {
        return collect(self::MENUS)
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
