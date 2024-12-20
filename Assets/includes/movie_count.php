<?php
    require_once("../data/db.php");

    $stmt = $db -> prepare("SELECT COUNT(*) AS movie_count FROM movies WHERE is_active = TRUE");
    $stmt -> execute();

    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    $movie_count = $row ? $row["movie_count"] : 0;

?>
