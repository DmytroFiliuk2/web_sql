<?php


include ('config.php');

try {
    $dbh = new PDO("{$driver}:host={$host};dbname={$dbName}", $user, $pass);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}