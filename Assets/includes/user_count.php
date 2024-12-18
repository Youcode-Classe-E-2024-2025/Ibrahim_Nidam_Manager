<?php
    require_once("../data/db.php");

    $stmt = $db->prepare("SELECT COUNT(*) AS user_count FROM roles WHERE role = 'user'");
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_count = $row ? $row["user_count"] : 0;

?>