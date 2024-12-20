<?php
require_once("../data/db.php");

$movie = null;
if (isset($_GET['id'])) {
    $query = "
        SELECT 
            m.movie_id, 
            m.title, 
            m.release_date,
            m.image_path,
            m.director,
            m.synopsis,
            GROUP_CONCAT(mg.genre_id) AS genre_ids
        FROM movies m
        LEFT JOIN movie_genres mg ON m.movie_id = mg.movie_id
        WHERE m.movie_id = ?
        GROUP BY m.movie_id
    ";
    $stmt = $db->prepare($query);
    $stmt->execute([$_GET['id']]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $selectedGenres = $movie['genre_ids'] ? explode(',', $movie['genre_ids']) : [];
}

if (!$movie) {
    header('Location: display_movies.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Edit Movie</h2>
            
            <form action="update_movie.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie['movie_id']) ?>">
                
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" 
                            value="<?= htmlspecialchars($movie['title']) ?>"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100">
                </div>
                
                <div class="mb-4">
                    <label for="director" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Director</label>
                    <input type="text" name="director" id="director" 
                            value="<?= htmlspecialchars($movie['director']) ?>"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100">
                </div>
                
                <div class="mb-4">
                    <label for="synopsis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Synopsis</label>
                    <textarea name="synopsis" id="synopsis" rows="4"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100"><?= htmlspecialchars($movie['synopsis']) ?></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="release-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Release Date</label>
                    <input type="date" name="release_date" id="release-date" 
                            value="<?= htmlspecialchars($movie['release_date']) ?>"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100">
                </div>
                
                <div class="mb-4">
                    <label for="genres" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Genres</label>
                    <select id="genres" name="genres[]" multiple
                            class="chosen-select w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100">
                        <?php
                        $stmt = $db->prepare("SELECT * FROM genres");
                        $stmt->execute();
                        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($genres as $genre) {
                            $selected = in_array($genre['genre_id'], $selectedGenres) ? 'selected' : '';
                            echo '<option value="' . $genre['genre_id'] . '" ' . $selected . '>' . htmlspecialchars($genre['name']) . '</option>';
                        }                
                        ?>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                    <img src="<?= htmlspecialchars($movie['image_path']) ?>" 
                            alt="Current movie poster" 
                            class="w-32 h-48 object-cover mb-2">
                    
                    <label for="new-image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Update Image</label>
                    <input type="file" name="new_image" id="new-image" 
                            accept="image/*"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100">
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="display_movie.php" 
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-[#7d2ae8] text-white rounded">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(".chosen-select").chosen({
            width: "100%",
            no_results_text: "No genres found matching"
        });

        document.getElementById('new-image').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</body>
</html>