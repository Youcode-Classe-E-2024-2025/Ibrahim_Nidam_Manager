<?php
    $dsn = "mysql:localhost;db=manager_db";
    $user = "root";
    $pass = "";

    try{
        $db = new PDO($dsn, $user, $pass);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // AUTOMATIC DATABASE CREATION START
        $sqlScript = file_get_contents("script.sql");
        if(!$sqlScript){
            throw new Exception("Could not read file");
        }
        $db -> exec($sqlScript);
        echo "Database and tables created successfully";
        // AUTOMATIC DATABASE CREATION END

        // TEST IF CONNECTION IS A SUCCESS START
        $query = $db -> $query("SELECT 1 ");
        if ($query) {
            echo "Database connected successfully.";
        }
        // TEST IF CONNECTION IS A SUCCESS END

    }
    catch(PDOException $e){
        die("Database error : " . $e -> getMessage());
    }