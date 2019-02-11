<nav id="sidebar" class="pcrt-sidebar">
    
    <div class="sidebar-header">
        <a href="/">
            <img src="/theme/img/logo.png" class="pcrt-logo" />
            <img src="/theme/img/logotipo.png" class="pcrt-logotipo" />
        </a>
    </div>

    <ul class="list-unstyled components">
        
        <li <?= (isset($_GET['r']) && $_GET['r'] == 'transport') ? 'class="active"' : '' ?>>
            <a href="?r=transport">
                <i class="fas fa-file-export"></i>
                <span>Trasporti</span>
            </a>
        </li>
        <li <?= (isset($_GET['r']) && $_GET['r'] == 'customer') ? 'class="active"' : '' ?>>
            <a href="?r=customer">
                <i class="fas fa-users"></i>
                <span>Clienti</span>
            </a>
        </li>
        <li <?= (isset($_GET['r']) && $_GET['r'] == 'destination') ? 'class="active"' : '' ?>>
            <a href="?r=destination">
                <i class="fas fa-globe-europe"></i>
                <span>Destinazioni</span>
            </a>
        </li>
        <li <?= (isset($_GET['r']) && $_GET['r'] == 'carrier') ? 'class="active"' : '' ?>>
            <a href="?r=carrier">
                <i class="fas fa-warehouse"></i>
                <span>Vettori</span>
            </a>
        </li>
        <li <?= (isset($_GET['r']) && $_GET['r'] == 'driver') ? 'class="active"' : '' ?>>
            <a href="?r=driver">
                <i class="fas fa-id-card-alt"></i>
                <span>Trasportatori</span>
            </a>
        </li>
        <li <?= (isset($_GET['r']) && $_GET['r'] == 'plate') ? 'class="active"' : '' ?>>
            <a href="?r=plate">
                <i class="fas fa-truck-moving"></i>
                <span>Targhe</span>
            </a>
        </li>
        
    </ul>

</nav>