<nav class="nav nav--desktop ">
    <div class="nav__front">
        <a href="index.php" class="nav__logo">
            <img src="./assets/imgs/logo.png" class="logo" />
        </a>
    </div>
    <div class="nav__back">
        <?php if (!$loggedin) { ?>
            <a href="login.php" class="btn btn--primary"><span class="button__text">Login</span></a>
        <?php } else { ?>
            <a href="logout.php" class="btn btn--primary--outline">Logout</a>
        <?php } ?>
        <?php if ($loggedin && $_SESSION["user"]["role"] !="user") : ?>
            <div class="toStudio">
                <a href="index.php" class="btn btn--primary">Verlaat Studio</a>
            </div>
        <?php endif; ?>
    </div>
</nav>
<nav class="nav nav--mobile" >
    <div class="nav__front">
        <a href="index.php" class="nav__logo">
            <img src="./assets/imgs/logo.png" class="logo" />
        </a>
    </div class="nav__back">
    <div class="dropdown show">
        <a class="btn btn--primary--outline dropdown-toggle" href="studio.php" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Studio
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <?php if ($loggedin && $_SESSION["user"]["role"] != "user"): ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item nav__link--primary" href="index.php">Verlaat studio</a>
            <?php endif; ?>
            <?php if($loggedin): ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item nav__link--primary" href="logout.php">Logout</a>
            <?php endif; ?>
        </div>
    </div>
    </nav>