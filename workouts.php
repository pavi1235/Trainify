<?php
require_once 'config/db.php';

$sql = "SELECT * FROM exercises ORDER BY exercise_name ASC";
$stmt = $trainify->prepare($sql);
$stmt->execute();

$exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>

<html lang="sv">

<head>    
 <meta charset="UTF-8">     
<meta name="viewport" content="width=device-width, initial-scale=1.0">     
<title>Registrera träning</title> 
 <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<?php include 'includes/header.php'; ?>



    <h1>Registrera träning</h1>

    <form action="workouts.php" method="POST">

        <h2>Träningsinformation</h2>

        <label for="workout_date">Datum:</label>
        <input type="date" name="workout_date" id="workout_date" required>

        <label for="duration">Träningstid (minuter):</label>
        <input type="number" name="duration" id="duration" min="1" required>


        <h2>Övningar</h2>

        <div id="exercise-container">

            <div class="exercise-item">

                <label>Välj övning:</label>

                <select name="exercises[0][exercise_id]" required>

                    <option value="">Välj en övning</option>

                    <?php foreach ($exercises as $row): ?>
                        <option value="<?php echo $row['exercise_id']; ?>">
                            <?php echo htmlspecialchars($row['exercise_name']); ?>
                        </option>
                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <button type="button" id="add-exercise">
            Lägg till övning
        </button>

        <br><br>

        <button type="submit">Registrera träningspass</button>

    </form>



<script>
    const exerciseOptions = `
        <?php foreach ($exercises as $row): ?>
            <option value="<?php echo $row['exercise_id']; ?>">
                <?php echo htmlspecialchars($row['exercise_name']); ?>
            </option>
        <?php endforeach; ?>
    `;
</script>

<script src="assets/js/script.js"></script>

</body> 
</html>