<?php

session_start();

require_once 'config/functions.php';

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if ($username !== '' && $name !== '' && $email !== false && $password !== '') {

        $felt = [
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        if (addUser($felt)) {

            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;

            header('Location: index.php');
            exit;

        } else {
            $error = true;
        }

    } else {
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera dig - FitQuest</title>
</head>

<body>

    <h1>Skapa ett konto på FitQuest</h1>

    <p><a href="login.php">Har du redan ett konto? Logga in här.</a></p>

    <?php if ($error): ?>
        <p>Kontrollera dina uppgifter. Användarnamnet eller e-postadressen kanske redan används.</p>
    <?php endif; ?>

    <form method="POST" action="">

        <label for="username">Användarnamn:</label>
        <input type="text" id="username" name="username" required>

        <br>

        <label for="name">Namn:</label>
        <input type="text" id="name" name="name" required>

        <br>

        <label for="email">E-post:</label>
        <input type="email" id="email" name="email" required>

        <br>

        <label for="password">Lösenord:</label>
        <input type="password" id="password" name="password" required>

        <br>

        <button type="submit">Registrera</button>

    </form>

</body>
</html>