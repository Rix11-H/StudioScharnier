<?php

include_once("bootstrap.php");

session_start();

// variable loggedin is used to see if user is logged in or not
if (isset($_SESSION["user"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Scharnier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--- css --->
    <link rel="stylesheet" href="css/app.css?v=<?php echo time() ?>">
</head>

<body>

    <?php include_once("Includes/nav.inc.php"); ?>

    <main class="landing">
        <div class="background">
            <div class="content">
                <img class="landing__logo" src="./assets/imgs/logo.png" alt="Studio Scharnier">
            </div>
        </div>
        <section class="landingsection landingsection--alter" style="max-width:60%;">
        <h2 >Wat is Studio Scharnier?</h2>
            <p>Met Studio Scharnier willen we veilig platform bieden voor ieders verhalen, met het oog op het bevorderen van wederzijds respect en begrip voor ieders situatie.</p>
        </section>
        <section class="landingsection what">
            <div class="right">
                    <img class="mockup" src="./assets/imgs/mockupStudioScharnier.png" alt="Mockup image">
            </div>
            <div class="left">
                <h3>Ontstaan</h3>
                <p>In onze huidige, prestatiegerichte maatschappij leven mensen steeds meer naast elkaar, in plaats van mét elkaar.
                    Het gebrek aan inzicht in elkaars leven en de keuzes die we maken, zorgt dagelijks voor onbegrip tussen medemensen.
                    <br>Met studio Scharnier willen wij een poort openzetten naar het beter leren kennen van onze naasten.
                </p>
                <h3>Ons concept</h3>
                <p>Studio Scharnier is een cross-mediaal contentplatform dat allerlei kleine gemeenschappen en organisaties als doelgroep heeft.
                    We focussen ons in de eerste plaats op kleine gemeenschappen: buurt- en jeugdhuizen, maar willen daarnaast de kans niet wegnemen bij lokale besturen, scholen en maatschappelijke organisaties om van onze dienst gebruik te maken.
                </p>
            </div>
        </section>
        <section class="landingsection more">
            <div class="left">
            <h3>Concreter</h3>
            <p>Denk aan een soort youtube, maar niet enkel voor videos. Bovendien kan jouw organisatie én jijzelf bepalen hoeveel en welke content al dan niet openbaar komt te staan, opdat we de veiligheid en privacy van de gebruiker willen optimaliseren.</p>
            <p>Een organisatie kan tegen een abonnementsprijs een server aanmaken op het platform, waarna leden, sympathisanten,... kunnen uitgenodigd worden om deel te nemen.
                Deze kunnen dan inloggen en de verhalen binnen de organisatie bekijken. Wil je zelf een verhaal delen? Dan kan je dit steeds inzenden naar de "redactie" van jou organisatie.
            </p>
            </div>
            <div class="right">
                <img class="workingSS" src="https://images.pexels.com/photos/1970801/pexels-photo-1970801.jpeg?cs=srgb&dl=pexels-malte-luk-1970801.jpg&fm=jpg" alt="Hoe werkt studio scharnier">
            </div>

        </section>
        <section class="landingsection landingsection--alter">
            <h2>Persoonlijke aanpak</h2>
            <p>Naast het basisplatform, staan wij ook steeds open extra functionaliteiten, een leuke vormgeving, etc. toe te voegen indien een bepaalde organisatie dit zou wensen.
                Uiteraard wordt begrepen dat we hiervoor een extra kost zullen moeten aanrekenen, maar dit steeds in overleg met u als klant.
            </p>
        </section>
        <section class="landingsection landingsection--alter contact">
            <h2>Interesse?</h2>
            <p>Neem gerust contact met ons op!</p>
            <a href="mailto:ricky.heylen@hotmail.be?cc=marthemaere@gmail.com&subject=Interesse in Studio Scharnier" class="btn btn--primary--outline">Contact</a>
        </section>
    </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>

</html>