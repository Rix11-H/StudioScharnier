<nav>
    <div class="nav__front">
        <a href="index.php" class="nav__logo">
            <img src="./assets/imgs/278087737_3045400305709969_4315556377183470121_n.png" class="logo"/>
        </a>
    </div>
    <div class="nav__back">
        <a href="radio.php" class="nav__link">Radio</a>
        <a href="video.php" class="nav__link">Video</a>
        <a href="beeld.php" class="nav__link">Beeld</a>
        <a href="texts.php" class="nav__link">Teksten</a>
        <?php if (!$loggedin) { ?>
            <a href="login.php" class="btn btn--primary"><span class="button__text">Login</span></a>
        <?php } else { ?>
            <a href="logout.php" class="btn btn--primary--outline"><span class="button__text">Logout</span></a>
        <?php } ?>
    </div>

</nav>