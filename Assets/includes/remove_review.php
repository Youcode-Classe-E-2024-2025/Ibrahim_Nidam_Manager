<?php
require_once("../data/db.php");
require_once("slug_id.php");

if (!isset($_GET['review_id'])) {
    die('Review ID not provided.');
}

$reviewId = $_GET['review_id'];

$query = $db->prepare("SELECT * FROM reviews WHERE review_id = :review_id");
$query->execute(['review_id' => $reviewId]);
$review = $query->fetch(PDO::FETCH_ASSOC);

if (!$review) {
    die('Review not found.');
}

$archiveId = slug("archive");

$archiveData = json_encode($review);
$archiveQuery = $db->prepare("
    INSERT INTO archives (archive_id, original_id, archived_data, archived_by_user_id)
    VALUES (:archive_id, :original_id, :archived_data, :user_id)
");
$archiveSuccess = $archiveQuery->execute([
    'archive_id' => $archiveId,
    'original_id' => $reviewId,
    'archived_data' => $archiveData,
    'user_id' => $review['user_id'],
]);

if ($archiveSuccess) {
    $deleteQuery = $db->prepare("DELETE FROM reviews WHERE review_id = :review_id");
    $deleteQuery->execute(['review_id' => $reviewId]);

    header('Location: user_dash.php');
    exit;
} else {
    die('Failed to archive the review.');
}
