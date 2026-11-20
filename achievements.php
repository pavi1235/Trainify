<?php

session_start();

require_once 'config/db.php';

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}



$stmt = $trainify->prepare($sql);

$stmt->bindValue(':user_id', $_SESSION['user_id']);

$stmt->execute();

$achievements = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Achievements - FitQuest</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main>

        <h1>Mina prestationer</h1>

        <?php if (count($achievements) > 0): ?>

            <?php foreach ($achievements as $achievement): ?>

                <div class="achievement">

                    <h2>
                        <?php echo htmlspecialchars($achievement['achievement_name']); ?>
                    </h2>

                    <p>
                        <?php echo htmlspecialchars($achievement['description']); ?>
                    </p>

                    <p>
                        XP-belöning:
                        <?php echo $achievement['xp_reward']; ?> XP
                    </p>

                    <p>
                        Upplåst:
                        <?php echo $achievement['unlocked_at']; ?>
                    </p>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>Du har inte låst upp några prestationer ännu.</p>

        <?php endif; ?>

    </main>

</body>
</html>