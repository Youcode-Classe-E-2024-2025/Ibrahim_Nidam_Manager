<?php
require_once("../data/db.php");
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_dash.php?error=Invalid archive ID");
    exit;
}

$originalId = $_GET['id'];
$userId = $_SESSION['user_id'] ?? null;

try {
    $db -> beginTransaction();

    $updateStmt = $db->prepare("UPDATE movies SET is_active = TRUE WHERE movie_id = ?");
    $updateStmt->execute([$originalId]);

    $deleteStmt = $db->prepare("DELETE FROM archives WHERE original_id = ?");
    $deleteStmt->execute([$originalId]);

    $db->commit();

    header("Location: admin_dash.php?success=Movie reactivated successfully");
    exit;

} catch (Exception $e) {
    $db -> rollBack();
    $errorMessage = "Error reactivating movie: " . $e->getMessage();
    header("Location: admin_dash.php?error=" . urlencode($errorMessage));
    exit;
}
