<?php

$host_trainify = "localhost";
$dbname_trainify = "Trainify";
$username_trainify = "Trainify";
$password_trainify = "PaviochRicky09";

try {
  $trainify = new PDO("mysql:host=$host_trainify;dbname=$dbname_trainify", $username_trainify, $password_trainify);
  // set the PDO error mode to exception
  $trainify->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  echo "Connected successfully"; // denna rad kan tas bort om allt fungerar
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

