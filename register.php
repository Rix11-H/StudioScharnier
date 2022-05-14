<?php

include_once("bootstrap.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Login | Studio Scharnier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--- css --->
    <link rel="stylesheet" href="css/app.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include_once("Includes/nav.inc.php"); ?>
    <main class="login">
        <div class="background">
            <div class="content">
                <form class="form form--account">
                    <h1 class="pb-3">Register</h1>
                    <div class="form__flex d-flex justify-content-stretch">
                        <div class="form-group w-50 mr-2">
                            <label for="firstName">Voornaam</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Jouw voornaam">
                        </div>
                        <div class="form-group w-50 ml-2">
                            <label for="lastName">Familienaam</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Jouw familienaam">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Emailadres</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Wachtwoord</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Jouw wachtwoord">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Bevestig je wachtwoord</label>
                        <input type="passwordConfirm" class="form-control" id="exampleInputPassword2" placeholder="Jouw wachtwoord">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label mb-4" for="exampleCheck1">Agree to terms</label>
                    </div>
                    <input type="submit" class="btn btn--primary" value="Register"></input>
                    <hr class="mt-4">
                    <small id="noAccountYet" class="form-text text-muted">Already have an account? | <a href="login.php" class="card__link">Login</a></small>
                </form>
            </div>
        </div>
    </main>
    <?php include_once("Includes/footer.inc.php"); ?>
</body>

</html>