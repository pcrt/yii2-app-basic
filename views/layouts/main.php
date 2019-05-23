<?php

use app\assets\AppAsset;
use yii\web\View;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= $this->calcTitle($this->title) ?></title>

    <?php $this->head() ?>

    <?= $this->render('favicon.html') ?>

  </head>

  <body>
  <?php $this->beginBody() ?>

    <div class="wrapper">

      <?= (!Yii::$app->user->isGuest) ? $this->render('_sidebar') : '' ?>

      <div id="content" <?= (Yii::$app->user->isGuest) ? 'class="guest"' : '' ?>>

        <?= (!Yii::$app->user->isGuest) ? $this->render('_header') : '' ?>

        <div class="pcrt-wrapper <?= (Yii::$app->user->isGuest) ? 'p-0' : '' ?>">
          <?= $content ?>
        </div>

      </div>

    </div>


    <?php if (!\Yii::$app->user->isGuest): ?>
      <?php
      $this->registerJs(
    "
          $(document).ready(function() {
            checkTermCondition('".\Yii::t('app', 'Term and Condition') ."');
          });
          ",
    View::POS_READY,
    'checkTermCondition'
      );
      ?>
    <?php endif; ?>


  <?php $this->endBody() ?>

  <script src="/src/utility.js" type="text/javascript"></script>

  <script src="/node_modules/anno.js/dist/anno.js" type="text/javascript"></script>

  <script>

    $('[name=language]').on('select2:select', function (e) {
        let language = $(e.target).val()
        $.get('/site/change-lang?local=' + language, function(data) {
            //location.reload()
        })
    });


  <?php if (!\Yii::$app->user->isGuest && !Yii::$app->user->identity->tutorial_check) {
          ?>
      var anno1 = new Anno({
        target : '#infoBtn',
        content: '<div id="welcomeAI"></div><div><?= Yii::t('app', 'Here you can find all the useful information to make the best use of B2connPRO.')  ?></div>',
        className: 'anno-highlight',
        position: 'center-left',
        buttons: [
          {
            text: 'Ok',
            className: 'btn btn-primary',
            click: function(anno, evt){
              //imposto come tutorial completato
              $.get('/user/tutorial-complete?id=<?= Yii::$app->user->identity->id ?>', function(data) {
                //location.reload()
              })

              anno.hide()
              $('.pcrt-row-header').css('background', '#fff')
              $('#langContainer').css('opacity', '1')

            }
          }
        ]
      })

      anno1.show()

      //correzione colore header
      $('.pcrt-row-header').css('background', 'rgba(255,255,255,.1)')
      $('#langContainer').css('opacity', '.1')
    <?php
      } ?>
  </script>

    <?php if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1'): ?>
      <script src="https://cdn.logrocket.io/LogRocket.min.js" crossorigin="anonymous"></script>
      <script>window.LogRocket && window.LogRocket.init('fraticelli-inc/b2conn');</script>
      <?php if (!\Yii::$app->user->isGuest): ?>
      <script>
        // This is an example script - don't forget to change it!
        LogRocket.identify('<?= Yii::$app->user->identity->id ?>', {
          name: '<?= Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname ?>',
          email: '<?= Yii::$app->user->identity->email ?>',

          username: '<?= Yii::$app->user->identity->username ?>',
        });
      </script>
      <?php endif; ?>
    <?php endif; ?>

  </body>
</html>
<?php $this->endPage() ?>
