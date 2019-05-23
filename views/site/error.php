<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error text-center">

    <div class="text-center text-danger"><i class="fas fa-exclamation-circle fa-10x"></i></div>

    <div class="mx-auto mt-4" style="max-width:450px;">
        <div class="alert alert-danger text-center">
            <?= nl2br(Html::encode($message)) ?>
        </div>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
