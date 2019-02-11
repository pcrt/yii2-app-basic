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
                        <div class="wksp-title">Pagina: <span><?= $this->title ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="pcrt-user">     
            <div class="dropdown">
                <a href="#" class="userbtn" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!--<img src="https://via.placeholder.com/50" />-->
                    <div class="ml-2">
                        <div><?= (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->username : '' ?></div>
                        <span class="d-block font-400">ADMINISTRATOR</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item" type="button" href="/?r=site/logout">Esci</a>
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
    <!--<div class="container-fluid b2cn-form pcrt-filter pl-0 pr-0">
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <input name="suppliername" id="namesupplier" type="text" class=" b2cn-input form-control" placeholder="Search by name...">
            </div>
        </div>

    </div>-->
</nav>