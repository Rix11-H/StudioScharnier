<nav class="nav nav--desktop ">
    <div class="nav__front">
        <a href="index.php" class="nav__logo">
            <img src="./assets/imgs/logo.png" class="logo" />
        </a>
    </div>
    <div class="nav__back">
        <a href="index.php" class="nav__link">Home</a>
        <a href="audio.php" class="nav__link">Audio</a>
        <a href="video.php" class="nav__link">Video</a>
        <a href="beeld.php" class="nav__link">Beeld</a>
        <a href="texts.php" class="nav__link">Teksten</a>
        <?php if (!$loggedin) { ?>
            <a href="login.php" class="btn btn--primary"><span class="button__text">Login</span></a>
        <?php } else { ?>
            <a href="logout.php" class="btn btn--primary--outline">Logout</a>
        <?php } ?>
        <?php if ($loggedin && $_SESSION["user"]["role"] !="user") : ?>
            <div class="toStudio">
                <a href="studio.php" class="btn btn--primary">Go to Studio</a>
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
        <a class="btn btn--primary--outline dropdown-toggle" href="index.php" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Home
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item nav__link" href="audio.php">audio</a>
            <a class="dropdown-item nav__link" href="video.php">Video</a>
            <a class="dropdown-item nav__link" href="texts.php">Tekst</a>
            <a class="dropdown-item nav__link" href="beeld.php">Beeld</a>
            <?php if ($loggedin && $_SESSION["user"]["role"] != "user"): ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item nav__link--primary" href="studio.php">Studio</a>
            <?php endif; ?>
            <?php if($loggedin): ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item nav__link--primary" href="logout.php">Logout</a>
            <?php else: ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item nav__link--primary" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
    </nav>