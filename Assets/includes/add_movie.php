<?php
require_once("../data/db.php");
require_once("slug_id.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];
    $director = $_POST['director'];
    $synopsis = $_POST['synopsis'];
    $genres = $_POST['genres'] ?? [];
    $image_path = null;

    // Validate and upload the image
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../data/uploads/";
        $image_name = slug("image_id") . "-" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            die("Error uploading the image.");
        }
    }

    // Generate unique movie ID
    $movie_id = slug("movie_id");

    // Insert movie into the database
    try {
        $db->beginTransaction();

        $stmt = $db->prepare("INSERT INTO movies (movie_id, title, release_date, director, synopsis, image_path) 
                                VALUES (:movie_id, :title, :release_date, :director, :synopsis, :image_path)");
        $stmt->execute([
            ":movie_id" => $movie_id,
            ":title" => $title,
            ":release_date" => $release_date,
            ":director" => $director,
            ":synopsis" => $synopsis,
            ":image_path" => $image_path,
        ]);

        // Insert movie genres
        $stmt = $db->prepare("INSERT INTO movie_genres (movie_id, genre_id) VALUES (:movie_id, :genre_id)");
        foreach ($genres as $genre_id) {
            $stmt->execute([
                ":movie_id" => $movie_id,
                ":genre_id" => $genre_id,
            ]);
        }

        $db->commit();

        echo "Movie added successfully!";
        header("Location: admin_dash.php");

    } catch (Exception $e) {
        $db->rollBack();
        die("Error adding movie: " . $e->getMessage());
    }
}
?>
