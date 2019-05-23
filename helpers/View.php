<?php

namespace app\helpers;

class View extends \yii\web\View
{
    public $tabTitle;

    //set page title
    public function calcTitle($path = false)
    {
        $base = \Yii::$app->params['name'];
        if ($path !==  false) {
            return $path . ' | ' . $base;
        } else {
            return $base;
        }
    }
}
