<?php
    require_once("../data/db.php");

    if(isset($_GET["role_id"])){
        $role_id =  $_GET["role_id"];

        $stmt = $db -> prepare("UPDATE roles SET role = CASE WHEN role = 'admin' THEN 'user' ELSE 'admin' END WHERE role_id = :id");
        $stmt -> bindParam(":id", $role_id, PDO::PARAM_STR);

        $stmt -> execute();
        header("Location: admin_dash.php");
    }