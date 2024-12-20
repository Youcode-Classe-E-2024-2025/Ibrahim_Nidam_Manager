<?php
    require_once("../data/db.php");

    $stmt = $db->prepare("SELECT COUNT(*) AS admin_count FROM roles WHERE role = 'admin'");
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $admin_count = $row ? $row["admin_count"] : 0;

?>