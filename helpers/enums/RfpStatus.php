<?php

namespace app\helpers\enums;

use yii2mod\enum\helpers\BaseEnum;

class RfpStatus extends BaseEnum
{
    const OPEN = 0;
    const NEGOTIATE = 10;
    const CLOSE = 20;
    
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
        self::OPEN => 'Open',
        self::NEGOTITATE => 'Negotiating',
        self::CLOSE => 'Closed',
    ];
}
