<?php

namespace app\helpers\enums;

use yii2mod\enum\helpers\BaseEnum;

class Role extends BaseEnum
{
    const ADMIN = 'admin';
    const SUPPLIER = 'supplier';
    const TECHNICIAN = 'technician';
    const BUYER = 'buyer';
    const SUPERVISOR = 'supervisor';

    
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
        self::ADMIN => 'Admin',
        self::SUPPLIER => 'Supplier',
        self::TECHNICIAN => 'Technician',
        self::BUYER => 'Buyer',
        self::SUPERVISOR => 'Supervisor',
    ];
}
