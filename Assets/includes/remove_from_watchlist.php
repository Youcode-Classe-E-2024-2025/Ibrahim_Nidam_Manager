<?php
require_once("../data/db.php");
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
    // Get user's watchlist ID
    $watchlistQuery = $db->prepare("SELECT watchlist_id FROM watchlists WHERE user_id = :user_id");
    $watchlistQuery->execute(['user_id' => $user_id]);
    $watchlist = $watchlistQuery->fetch(PDO::FETCH_ASSOC);
    
    if ($watchlist) {
        // Remove movie from watchlist
        $removeMovie = $db->prepare("
            DELETE FROM watchlist_movies 
            WHERE watchlist_id = :watchlist_id AND movie_id = :movie_id
        ");
        $removeMovie->execute([
            'watchlist_id' => $watchlist['watchlist_id'],
            'movie_id' => $movie_id
        ]);
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Watchlist not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}