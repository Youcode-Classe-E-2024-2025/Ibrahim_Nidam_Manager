<?php
require_once("../data/db.php");
require_once("slug_id.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Invalid request method']));
}

$user_id = "user";
$movie_id = $_POST['movie_id'] ?? '';

if (empty($movie_id)) {
    die(json_encode(['success' => false, 'message' => 'Movie ID is required']));
}

try {
    $watchlistQuery = $db->prepare("SELECT watchlist_id FROM watchlists WHERE user_id = :user_id");
    $watchlistQuery->execute(['user_id' => $user_id]);
    $watchlist = $watchlistQuery->fetch(PDO::FETCH_ASSOC);

    if (!$watchlist) {
        $watchlist_id = slug('watchlist');
        $createWatchlist = $db->prepare("
            INSERT INTO watchlists (watchlist_id, user_id, name)
            VALUES (:watchlist_id, :user_id, 'My Watchlist')
        ");
        $createWatchlist->execute([
            'watchlist_id' => $watchlist_id,
            'user_id' => $user_id
        ]);
    } else {
        $watchlist_id = $watchlist['watchlist_id'];
    }

    $checkMovie = $db->prepare("
        SELECT COUNT(*) as count 
        FROM watchlist_movies 
        WHERE watchlist_id = :watchlist_id 
        AND movie_id = :movie_id
    ");
    $checkMovie->execute([
        'watchlist_id' => $watchlist_id,
        'movie_id' => $movie_id
    ]);
    $exists = $checkMovie->fetch(PDO::FETCH_ASSOC);

    if ($exists['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Movie already in watchlist']);
        exit;
    }

    $addMovie = $db->prepare("
        INSERT INTO watchlist_movies (watchlist_id, movie_id)
        VALUES (:watchlist_id, :movie_id)
    ");
    $addMovie->execute([
        'watchlist_id' => $watchlist_id,
        'movie_id' => $movie_id
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}