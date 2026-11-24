<?php

require_once 'config/db.php';

// ==========================================
// 1. REGISTRERA ANVÄNDARE
// ==========================================

function addUser($felt) {

    global $trainify;

    $sql = "INSERT INTO users
            (username, name, email, password, xp, level)
            VALUES
            (:username, :name, :email, :password, 0, 1)";

    $stmt = $trainify->prepare($sql);

    $passwordHash = password_hash(
        $felt['password'],
        PASSWORD_DEFAULT
    );

    $stmt->bindValue(':username', $felt['username']);
    $stmt->bindValue(':name', $felt['name']);
    $stmt->bindValue(':email', $felt['email']);
    $stmt->bindValue(':password', $passwordHash);

    try {
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}


// ==========================================
// 2. LOGGA IN ANVÄNDARE
// ==========================================

function login($username, $password) {

    global $trainify;

    $sql = "SELECT *
            FROM users
            WHERE username = :username";

    $stmt = $trainify->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}


// ==========================================
// 3. HÄMTA ANVÄNDARE
// ==========================================

function getUser($username) {

    global $trainify;

    $sql = "SELECT user_id, username, name, email, xp, level
            FROM users
            WHERE username = :username";

    $stmt = $trainify->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// ==========================================
// 4. UPPDATERA ANVÄNDARE
// ==========================================

function updateUser($username, $name, $email, $password = null) {

    global $trainify;

    if (empty($password)) {

        $sql = "UPDATE users
                SET name = :name,
                    email = :email
                WHERE username = :username";

        $stmt = $trainify->prepare($sql);

        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);

    } else {

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "UPDATE users
                SET name = :name,
                    email = :email,
                    password = :password
                WHERE username = :username";

        $stmt = $trainify->prepare($sql);

        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $passwordHash);
    }

    try {
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}


// ==========================================
// 5. HÄMTA ANVÄNDARENS ACHIEVEMENTS
// ==========================================

function getUserAchievements($user_id) {

    global $trainify;

    $sql = "SELECT achievements.achievement_name,
                   achievements.description,
                   achievements.xp_reward,
                   user_achievements.unlocked_at
            FROM user_achievements
            JOIN achievements
            ON user_achievements.achievement_id = achievements.achievement_id
            WHERE user_achievements.user_id = :user_id";

    $stmt = $trainify->prepare($sql);

    $stmt->bindValue(':user_id', $user_id);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getWorkoutCount($user_id) {

    global $trainify;

    $sql = "SELECT COUNT(*)
            FROM workouts
            WHERE user_id = :user_id";

    $stmt = $trainify->prepare($sql);

    $stmt->bindValue(':user_id', $user_id);

    $stmt->execute();

    return $stmt->fetchColumn();
}


function getExercises() {

    global $trainify;

    $sql = "SELECT * FROM exercises
            ORDER BY exercise_name ASC";

    $stmt = $trainify->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalTrainingTime($user_id) {

    global $trainify;

    $sql = "SELECT SUM(duration)
            FROM workouts
            WHERE user_id = :user_id";

    $stmt = $trainify->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetchColumn() ?? 0;
}

function getPersonalRecords($user_id) {

    global $trainify;

    $sql = "SELECT exercises.exercise_name,
                   MAX(sets.weight) AS max_weight
            FROM sets
            JOIN workout_exercises
                ON sets.workout_exercise_id = workout_exercises.workout_exercise_id
            JOIN exercises
                ON workout_exercises.exercise_id = exercises.exercise_id
            JOIN workouts
                ON workout_exercises.workout_id = workouts.workout_id
            WHERE workouts.user_id = :user_id
            GROUP BY exercises.exercise_id, exercises.exercise_name";

    $stmt = $trainify->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>