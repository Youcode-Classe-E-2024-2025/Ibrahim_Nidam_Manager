<?php
require_once("../data/db.php");
require_once("slug_id.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $director = $_POST['director'];
    $synopsis = $_POST['synopsis'];
    $release_date = $_POST['release_date'];
    $genres = isset($_POST['genres']) ? $_POST['genres'] : [];
    
    $db -> beginTransaction();
    
    try {
        $query = "UPDATE movies SET title = ?, director = ?, synopsis = ?, release_date = ? WHERE movie_id = ?";
        $stmt = $db -> prepare($query);
        $stmt->execute([$title, $director, $synopsis, $release_date, $movie_id]);
        
        if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../data/uploads/poster_edits/';
            $fileExtension = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
            $newFileName = slug("image_id") . '.' . $fileExtension;
            $uploadPath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadPath)) {
                $query = "UPDATE movies SET image_path = ? WHERE movie_id = ?";
                $stmt = $db->prepare($query);
                $stmt->execute([$uploadPath, $movie_id]);
            }
        }
        
        $query = "DELETE FROM movie_genres WHERE movie_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$movie_id]);
        
        if (!empty($genres)) {
            $values = array_fill(0, count($genres), '(?, ?)');
            $query = "INSERT INTO movie_genres (movie_id, genre_id) VALUES " . implode(', ', $values);
            
            $params = [];
            foreach ($genres as $genre_id) {
                $params[] = $movie_id;
                $params[] = $genre_id;
            }
            
            $stmt = $db->prepare($query);
            $stmt->execute($params);
        }
        
        $db->commit();
        header('Location: admin_dash.php');
        exit();
        
    } catch (Exception $e) {
        $db->rollBack();
        echo "Error updating movie: " . $e->getMessage();
    }
}
?>