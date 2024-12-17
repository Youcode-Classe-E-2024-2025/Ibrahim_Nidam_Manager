<?php
    $host = "localhost";
    $dbname = "manager_db";
    $user = "root";
    $pass = "";

    try {
        // Connect to MySQL without specifying the database
        $dsn = "mysql:host=$host";
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create the database if it doesn't exist
        $db->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        $db->exec("USE $dbname");

        // Execute script.sql to create tables
        $sqlScript = file_get_contents(__DIR__ . "/script.sql");
        $db->exec($sqlScript);

    } catch (PDOException $e) {
        error_log("Database Setup Error: " . $e->getMessage());
        die("Database error: " . $e->getMessage());
    }
?>
