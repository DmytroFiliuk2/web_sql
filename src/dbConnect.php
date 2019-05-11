<?php


include ('config.php');

try {

    $dbh = new PDO("{$driver}:host={$host};dbname={$dbName}", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}