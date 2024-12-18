<?php
    require_once("../data/db.php");

    $stmt = $db -> prepare("SELECT COUNT(*) AS archive_count FROM archives");
    $stmt -> execute();

    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    $archive_count = $row ? $row["archive_count"] : 0;

?>
