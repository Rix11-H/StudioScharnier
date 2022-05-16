<?php

include_once("bootstrap.php");

if (!empty($_POST)) {
    try {
        $user = new User();

        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        if($_POST["password"] != $_POST["password2"]) {
            throw new Exception("Passwords do not match.");
            echo "Passwords do not match.";
        } else {
            $user->setPassword($_POST['password']);
        }
        $user->setEmail($_POST['email']);

        $email = $user->getEmail();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();

        $user->register();

        session_start();
        $_SESSION['user'] = $user->findByEmail($email);
        header("Location: index.php");
    } catch (Throwable $e) {
        $error = $e->getMessage();
        header("Location: register.php?error=$error");
    }
}


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
    <main class="login">
        <div class="background">
            <div class="content">
                <form action="" method="post" class="form form--account">
                    <h1 class="pb-3">Register</h1>
                    <div class="form__flex d-flex justify-content-stretch">
                        <div class="form-group w-50 mr-2">
                            <label for="firstName">Voornaam</label>
                            <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Jouw voornaam">
                        </div>
                        <div class="form-group w-50 ml-2">
                            <label for="lastName">Familienaam</label>
                            <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Jouw familienaam">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Emailadres</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Wachtwoord</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Jouw wachtwoord">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Bevestig je wachtwoord</label>
                        <input type="password" name="password2" class="form-control" id="exampleInputPassword2" placeholder="Jouw wachtwoord">
                        <?php 
                            if(!empty($_POST["password"]) && !empty($_POST["password2"])) {
                                if($_POST["password"] != $_POST["password2"]){ echo "<small>Passwords does not match.</small>"; }
                            } ?>
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