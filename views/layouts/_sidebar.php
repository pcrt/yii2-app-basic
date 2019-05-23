<nav id="sidebar" class="pcrt-sidebar">

    <div class="sidebar-header">
        <a href="/">
            <img src="/img/logo.png" class="pcrt-logo" />
            <img src="/img/logotipo.png" class="pcrt-logotipo" />
        </a>
    </div>

    <ul class="list-unstyled components">

        <?php //if (\Yii::$app->user->can('readDashboard')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'class="active"' : '' ?>>
            <a href="/dashboard">
                <i class="fas fa-tv"></i>
                <span><?= Yii::t('app', 'Dashboard') ?></span>
            </a>
        </li>
        <?php //endif; ?>
        <?php if (\Yii::$app->user->can('readSuppliers')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'suppliers') !== false) ? 'class="active"' : '' ?>>
            <a href="/suppliers">
                <i class="fas fa-industry"></i>
                <span><?= Yii::t('app', 'Suppliers') ?></span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('readUsers')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'user') !== false) ? 'class="active"' : '' ?>>
            <a href="/user">
                <i class="fas fa-users"></i>
                <span><?= Yii::t('app', 'Users') ?></span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('readCategories')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'categories') !== false) ? 'class="active"' : '' ?>>
            <a href="/categories">
                <i class="fas fa-layer-group"></i>
                <span><?= Yii::t('app', 'Categories') ?></span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('readProducts')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'products') !== false) ? 'class="active"' : '' ?>>
            <a href="/products">
                <i class="fas fa-boxes"></i>
                <span><?= Yii::t('app', 'Products') ?></span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('readAllRfp') || \Yii::$app->user->can('readYourRfp')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'rfp-items') !== false) ? 'class="active"' : '' ?>>
            <a href="/rfp-items">
                <i class="fas fa-question-circle"></i>
                <span><?= Yii::t('app', 'Purchase requests') ?></span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (\Yii::$app->user->can('readAllRfq') || \Yii::$app->user->can('readYourRfq')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'rfqs-suppliers') === false && strpos($_SERVER['REQUEST_URI'], 'rfqs') !== false) ? 'class="active"' : '' ?>>
            <a href="/rfqs">
                <i class="fas fa-bullhorn"></i>
                <span><?= Yii::t('app', 'Requests for quote') ?></span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (\Yii::$app->user->can('readAllRfqSupplier')): ?>
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'rfqs-suppliers') !== false) ? 'class="active"' : '' ?>>
            <a href="/rfqs-suppliers">
                <i class="fas fa-bullhorn"></i>
                <span><?= Yii::t('app', 'Requests for quote') ?></span>
            </a>
        </li>
        <?php endif; ?>
        
        <!--<li id="help_li"<?= (strpos($_SERVER['REQUEST_URI'], 'site/docs') !== false) ? 'class="active"' : '' ?>>
            <a href="/site/docs">
                <i class="fas fa-info"></i>
                <span><?= Yii::t('app', 'Need Help') ?></span>
            </a>
        </li>-->
    </ul>
    
    
    
</nav>
