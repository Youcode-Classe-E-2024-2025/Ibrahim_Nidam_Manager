<?php
    $host = "localhost";
    $dbname = "manager_db";
    $user = "root";
    $pass = "";

    try {
        $dsn = "mysql:host=$host";
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        $db->exec("USE $dbname");

        $sqlScript = file_get_contents(__DIR__ . "/script.sql");
        $db->exec($sqlScript);

    } catch (PDOException $e) {
        error_log("Database Setup Error: " . $e->getMessage());
        die("Database error: " . $e->getMessage());
    }
?>
