<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Request password change';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login h-100 mt-4">
    <div class="text-center m-auto">
        <a href="/site/login">
            <img src="/img/logo.png" class="pcrt-logo" style="max-width:220px;" />
        </a>
    </div>
    <div class="mr-auto ml-auto mt-2 card" style="max-width: 480px;">
        <div class="card-body">
            <div class="title"><?= Yii::t('app', 'Request password change') ?></div>
            <?php $form = ActiveForm::begin([
                'validationStateOn' => false,
                'id' => 'login-form',
                'validationStateOn' => false,
                //'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-12 control-label'],
                ],
            ]); ?>

                <div class="form-group required">
                    <div class="col-lg-12">
                        <input type="text" id="recover" class="form-control" name="recover" value="<?= $default ?>" placeholder="<?= Yii::t('app', 'Username or email') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12 text-center">
                        <?= Html::submitButton(Yii::t('app', 'Recover'), ['class' => 'd-block btn btn-success btn-lg btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>



</div>
