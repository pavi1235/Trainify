<?php

session_start();

require_once 'config/functions.php';

// Kontrollera om användaren är inloggad
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Här hämtar vi senare användarens träningsstatistik från databasen

?>

    <!DOCTYPE html>
<html lang="sv">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Progress - FitQuest</title>

                <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main>

        <h1>My Progress</h1>

        <p>Follow your training development and track your achievements.</p>


        <!-- TRAINING OVERVIEW -->

        <section>

            <h2>Training Overview</h2>

            <div class="progress-container">

                <div class="progress-card">
                    <h3>Total Workouts</h3>
                    <p><?php echo $totalWorkouts; ?></p>
                </div>

                <div class="progress-card">
                    <h3>Total Training Time</h3>
                    <p>--</p>
                </div>

                <div class="progress-card">
                    <h3>Current Level</h3>
                    <p>--</p>
                </div>

                <div class="progress-card">
                    <h3>Total XP</h3>
                    <p>--</p>
                </div>

            </div>

        </section>


        <!-- PERSONAL RECORDS -->

        <section>

            <h2>Personal Records</h2>

            <div class="progress-container">

                <?php if (!empty($personalRecords)): ?>

                    <?php foreach ($personalRecords as $record): ?>

                        <div class="progress-card">

                            <h3>
                                <?php echo htmlspecialchars($record['exercise_name']); ?>
                            </h3>

                            <p>
                                <?php echo htmlspecialchars($record['max_weight']); ?> kg
                            </p>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <p>No personal records available yet.</p>

                <?php endif; ?>

            </div>

        </section>


        <!-- WORKOUT HISTORY -->

        <section>

            <h2>Workout History</h2>

            <?php if (!empty($workoutHistory)): ?>

                <?php foreach ($workoutHistory as $workout): ?>

                    <div class="progress-card">

                        <h3>
                            <?php echo htmlspecialchars($workout['workout_date']); ?>
                        </h3>

                        <p>
                            Duration:
                            <?php echo htmlspecialchars($workout['duration']); ?> minutes
                        </p>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>No workouts registered yet.</p>

            <?php endif; ?>

        </section>


        <!-- TRAINING PROGRESS -->

        <section>

            <h2>Training Progress</h2>

            <div class="progress-chart">

                <p>Your training progress chart will appear here.</p>

                <?php foreach ($personalRecords as $record): ?>

    <div class="progress-card">

        <h3>
            <?php echo htmlspecialchars($record['exercise_name']); ?>
        </h3>

        <p>
            <?php echo htmlspecialchars($record['max_weight']); ?> kg
        </p>

    </div>

<?php endforeach; ?>

            </div>

        </section>

    </main>

</body>

</html>