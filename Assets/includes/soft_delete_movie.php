<?php
    require_once("../data/db.php");
    require_once("slug_id.php");

    session_start();

    if (!isset($_GET['id'])) {
        header("Location: admin_dash.php?error=No movie specified");
        exit;
    }

    $movieId = $_GET['id'];
    $userId = $_SESSION['user_id'] ?? null;

    try {
        $db -> beginTransaction();

        $stmt = $db -> prepare("SELECT * FROM movies WHERE movie_id = ?");
        $stmt -> execute([$movieId]);
        $movieData = $stmt->fetch(PDO::FETCH_ASSOC);

        $archiveId = slug("archive_id");
        $archiveStmt = $db->prepare("INSERT INTO archives (archive_id, original_id, archived_data, archived_by_user_id) VALUES (?, ?, ?, ?)");
        
        $archiveStmt->execute([$archiveId,$movieId,json_encode($movieData),$userId]);

        $updateStmt = $db -> prepare("UPDATE movies SET is_active = FALSE WHERE movie_id = ?");
        
        $updateStmt->execute([$movieId]);
        $db -> commit();
        
        header("Location: admin_dash.php");
        exit;

    } catch (Exception $e) {
        $db -> rollBack();
        header("Location: admin_dash.php?error=" . urlencode($e->getMessage()));
        exit;
    }
?>
