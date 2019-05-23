<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
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
            <div class="title">Log in</div>
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

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => Yii::t('app', 'Username')]) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Password')]) ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-12\">{input} {label}</div>\n<div class=\"col-lg-12\">{error}</div>",
                ])
                ->label(Yii::t('app', 'Keep me logged in'), ['class' => 'm-0 ml-4']) ?>

                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="pointer" onclick="prepareRecover()"><?= Yii::t('app', 'Recover password') ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12 text-center">
                        <?= Html::submitButton('Log in', ['class' => 'd-block btn btn-success btn-lg btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php if (isset($_GET['error'])) {
                    ?>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['error'] ?>
                        </div>
                    </div>
                </div>
                <?php
                } ?>

                <?php if (isset($_GET['success'])) {
                    ?>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['success'] ?>
                        </div>
                    </div>
                </div>
                <?php
                } ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>



</div>


<script>
function prepareRecover() {
    let email = $('#loginform-username').val()

    window.location.href = 'request-password?default=' + email
}
</script>