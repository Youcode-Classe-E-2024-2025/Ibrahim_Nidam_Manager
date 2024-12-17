<?php
    require_once("../data/db.php");

    header("content-Type: application/json");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo json_encode(["error" => "Invalid Email format"]);
            exit;
        }

        if(empty($password)){
            echo json_encode(["error" => "Password is required"]);
            exit;
        }

        try{
            $stmt = $db -> prepare("SELECT user_id, role_id, password_hash FROM users WHERE email = ?");
            $stmt -> execute([$email]);
            $user = $stmt -> fetch(PDO::FETCH_ASSOC);

            if($user){
                if(password_verify($password, $user["password_hash"])){
                    session_start();
                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["role_id"] = $user["role_id"];

                    echo json_encode(["success" => "Login Successful."]);
                    exit;
                } else {
                    echo json_encode(["error" => "Password incorrect."]);
                    exit;
                }
            }
        } catch (PDOException $e){
            echo json_encode(["error" => "Database error : " . $e -> getMessage()]);
            exit;
        }
    } else {
        echo json_encode(["error" => "Invalid request method."]);
        exit;
    }