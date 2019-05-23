<?php

namespace app\helpers\enums;

use yii2mod\enum\helpers\BaseEnum;

class DocType extends BaseEnum
{
    const DURC = 1;
    const CONDGENCONTR = 2;
    const ISO9000 = 3;
    const ISO14000 = 4;
    const VISURACAMERALE = 5;
    const ALTRO = 6;
    
    /**
     * @var string message category
     * You can set your own message category for translate the values in the $list property
     * Values in the $list property will be automatically translated in the function `listData()`
     */
    public static $messageCategory = 'app';
    
    /**
     * @var array
     */
    public static $list = [
        self::DURC => 'Durc',
        self::CONDGENCONTR => 'Condizioni generali di contratto',
        self::ISO9000 => 'ISO:9000',
        self::ISO14000 => 'ISO:14000',
        self::VISURACAMERALE => 'Visura Camerale',
        self::ALTRO => 'Altro',
    ];
}
