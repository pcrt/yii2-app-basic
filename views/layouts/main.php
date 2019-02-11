<?php
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="it-IT">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= $this->calcTitle($this->title) ?></title>
    <style><?= $this->render('glyphicon.css') ?></style>
    <?php $this->head() ?>
    <!-- Include favicon generated file -->
    <?= $this->render('favicon.html') ?>
  </head>
  <body>
  <?php $this->beginBody() ?>
    <div class="wrapper">
      <?= (!Yii::$app->user->isGuest) ? $this->render('_sidebar') : '' ?>
      <div id="content">
        <?= (!Yii::$app->user->isGuest) ? $this->render('_header') : '' ?>
        <div class="pcrt-wrapper <?= (Yii::$app->user->isGuest) ? 'p-0' : '' ?>">
          <?= $content ?>
        </div>
      </div>
    </div>
  <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
