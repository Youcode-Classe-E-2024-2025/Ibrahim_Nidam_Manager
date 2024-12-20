<?php

require_once("../data/db.php");
require_once("slug_id.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    if (!preg_match("/^[A-Za-z]{2,50}(?:\s[A-Za-z]{2,50})*$/", $name)) {
        echo json_encode(["error" => "Invalid name format"]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "Invalid email format."]);
        exit;
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/", $pass)) {
        echo json_encode(["error" => "Password must be at least 8 characters long and contain both letters and numbers."]);
        exit;
    }

    try {
        $role_id = slug("roles");
        $role_name = "user";

        $insert_role_stmt = $db->prepare("INSERT INTO roles (role_id, role) VALUES (?, ?)");
        $insert_role_stmt->execute([$role_id, $role_name]);

        $user_id = slug("users");
        $pass_hashed = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $db->prepare("INSERT INTO users (user_id, role_id, username, email, password_hash) VALUES (?, ?, ?, ?, ?)");

        if ($stmt->execute([$user_id, $role_id, $name, $email, $pass_hashed])) {
            echo json_encode(["Success" => "User registered successfully.","user_id" => $user_id,"role_id" => $role_id]);
        } else {
            echo json_encode(["error" => "Failed to register user."]);
        }

    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
}
