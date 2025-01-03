<?php


namespace App\Http\Enums\Training;

/**
 * Class TrainingMenu
 * @package App\Http\Enums\Training
 */
class TrainingMenu
{
    const PUSH_UP = '腕立て伏せ';
    const SQUAT = 'スクワット';
    const CORE_TRAINING = '体幹';
    const HANDSTAND = '倒立';

    static function getSelectItems()
    {
        return [
            [
                'value' => self::PUSH_UP,
                'text' => self::PUSH_UP
            ],
            [
                'value' => self::SQUAT,
                'text' => self::SQUAT
            ],
            [
                'value' => self::CORE_TRAINING,
                'text' => self::CORE_TRAINING
            ],
            [
                'value' => self::HANDSTAND,
                'text' => self::HANDSTAND
            ]
        ];
    }
}
