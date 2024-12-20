<?php
require_once("../data/db.php");
require_once("slug_id.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = "user";
    $movie_id = $_POST['movie_id'];
    $rating = $_POST['rating'];
    $content = $_POST['review_content'];
    $review_id = slug("review_id");

    $query = "INSERT INTO reviews (review_id, user_id, movie_id, rating, content)
            VALUES (:review_id, :user_id, :movie_id, :rating, :content)
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':review_id' => $review_id,
        ':user_id' => $user_id,
        ':movie_id' => $movie_id,
        ':rating' => $rating,
        ':content' => $content
    ]);

    header("Location: user_dash.php");
    exit();
}
?>
