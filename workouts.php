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
    <title>Document</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
        <form action="workouts.php" method="POST">
    <h1>Registera träning</h1>
    <label for="workout_date">Datum:</label>
<input type="date" name="workout_date" id="workout_date" required>

<label for="duration">Träningstid (minuter):</label>
<input type="number" name="duration" id="duration" min="1" required>

   
        <label for="exercise">Välj övning:</label>
        <select name="exercise" id="exercise" required>
            <option value="">Välj en övning</option>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <option value="<?php echo $row['exercise_id']; ?>">

                    <?php echo htmlspecialchars($row['exercise_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="sets">Antal set:</label>
        <input type="number" name="sets" id="sets" required>
        <label for="reps">Antal reps:</label>
        <input type="number" name="reps" id="reps" required>
        <label for="weight">Vikt (kg):</label>
        <input type="number" name="weight" id="weight" step="0.1" required>
        <button type="submit">Registrera träning</button>
        
    </form>                  
</body>
</html>