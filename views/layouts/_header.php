<?php
use pcrt\widgets\select2\Select2;
use app\models\User;

?>

<nav class="navbar navbar-default pcrt-header">
    <div class="container-fluid pcrt-row-header">
        <div class="navbar-header">
            <div class="row m-0 align-items-center">
                <div class="col-auto p-0">
                    <button type="button" id="sidebarCollapse" class="btn btn-toogle navbar-btn pcrt-toogle-side" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                    <div class="col-auto p-0 ml-3">
                        <div class="wksp-title"><?= Yii::t('app', 'Page') ?>: <span><?= $this->title ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div>

        </div>
        <div class="pcrt-user">
            <div id="langContainer" class="d-inline-block mr-2" style="min-width: 70px">
                <?php
                if (isset(Yii::$app->user->identity)) {
                    $language = Yii::$app->user->identity->language;
                }

                echo Select2::widget([
                    'name' => 'language',
                    'items' => ['it-IT' => 'Italiano', 'en-GB' => 'English'],
                    'value' => (isset($language)) ? $language : 'en-GB',
                    'options' => [
                        'class' => 'form-control'
                    ],
                    'clientOptions' => [
                        'minimumResultsForSearch' => -1
                    ]
                ]);
                ?>
            </div>

            <div id="infoBtn" class="d-inline-block"><a href="/site/docs"><i class="far fa-question-circle fa-lg"></i></a></div>

            <div class="dropdown d-inline-block">
                <a href="#" class="userbtn" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!--<img src="https://via.placeholder.com/50" />-->
                    <div class="ml-2">
                        <div><?= (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname : '' ?></div>
                        <span class="d-block font-400">
                          <?php
                            $roles = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
                            $myrole = "";
                            foreach ($roles as $role) {
                                $myrole = $role->description;
                            }
                            echo strtoupper(Yii::t('app', $myrole));
                          ?>
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item" href="/profile/index"><?= Yii::t('app', 'Profile') ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/site/logout"><?= Yii::t('app', 'Logout') ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pcrt-head">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 align-self-center p-0">
            <h1 class="pcrt-title"><?= $this->title ?></h1>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 align-self-center p-0">
            <div class="head-buttons">
                <?= $this->blocks['actionButtons'] ?>
                <!--<a href="" class="btn btn-success"><i class="fas fa-plus"></i> NEW</a>-->
            </div>
        </div>
    </div>
    <?php if (isset($this->blocks['filterblock'])): ?>
    <div class="container-fluid b2cn-form pcrt-filter pl-0 pr-0">

                <!--<input name="suppliername" id="namesupplier" type="text" class="b2cn-input form-control" placeholder="Search by name...">-->
                <?= $this->blocks['filterblock'] ?>

    </div>
    <?php endif; ?>
</nav>
