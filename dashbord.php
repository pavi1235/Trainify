<?php
require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - trainify </title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    >

        <h1>Välkommen till trainify!</h1>

        <p>Här kan du hålla koll på din träning och följa dina framsteg.</p>

        <section>
            <h2>Din träningsöversikt</h2>

            <div>
                <h3>Träningspass</h3>
                <p>0</p>
            </div>

            <div>
                <h3>Träningstid</h3>
                <p>0 minuter</p>
            </div>

            <div>
                <h3>Senaste träningspasset</h3>
                <p>Inga träningspass registrerade ännu.</p>
            </div>

        </section>

        <section>
            <h2>Kom igång</h2>

         <button type="button" onclick="window.location.href='workouts.php'">
    Registrera träningspass
     </button>
           <button type="button" onclick="window.location.href='progress.php'">
    Visa dina framsteg
     </button>
        </section>

    

</body>
</html>