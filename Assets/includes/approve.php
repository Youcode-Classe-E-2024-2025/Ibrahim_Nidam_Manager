<?php
    require_once("../data/db.php");

    if(isset($_GET["user_id"])){
        $user_id = $_GET["user_id"];
        $stmt = $db -> prepare("UPDATE users SET is_active = TRUE WHERE user_id = :user_id");
        $stmt -> bindParam(":user_id", $user_id, PDO::PARAM_STR);

        $stmt -> execute();
        header("Location: admin_dash.php");
    }