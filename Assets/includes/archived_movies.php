<?php
    require_once("../data/db.php");

    $query = "
        SELECT
            m.movie_id,
            m.title,
            m.release_date,
            m.image_path,
            GROUP_CONCAT(g.name SEPARATOR ', ') AS genres
        FROM movies m
        LEFT JOIN movie_genres mg ON m.movie_id = mg.movie_id
        LEFT JOIN genres g ON mg.genre_id = g.genre_id
        WHERE m.is_active = FALSE
        GROUP BY m.movie_id
    ";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Archieved Movies</h2>
    <div class="movies-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 cursor-pointer">
    <?php if(!empty($movies)): ?>

        <?php foreach ($movies as $movie): ?>
            <div class="border-2 rounded group relative bg-transparent overflow-hidden max-w-xs mx-auto">
                <!-- Corner Icons -->
                <div class="absolute top-0 left-0 z-10 w-8 h-8 hover:bg-white/50 flex items-center justify-center">
                    <a href="reactivate_movie.php?id=<?= $movie['movie_id'] ?>" class="text-white text-lg">×</a>
                </div>
                <div class="absolute top-0 right-0 z-10 w-8 h-8 hover:bg-white/50 flex items-center justify-center" 
                        onclick="window.location.href='edit_movie_form.php?id=<?= $movie['movie_id'] ?>'">
                    <span class="text-white text-lg">?</span>
                </div>
                
                <!-- Movie Poster -->
                <div class="movie-image relative aspect-[2/3]">
                    <img src="<?= htmlspecialchars($movie['image_path']) ?>"
                            alt="<?= htmlspecialchars($movie['title']) ?>"
                            class="w-full h-full object-cover rounded-sm border border-gray-700">

                    <div class="absolute inset-0 bg-black bg-opacity-75 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-sm text-center px-4"><?= htmlspecialchars($movie['genres']) ?></p>
                    </div>
                </div>
                <!-- Movie Title and Year -->
                <div class="border-t-2 p-2">
                    <h3 class="text-xs font-normal text-gray-200"><?= htmlspecialchars($movie['title']) ?></h3>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars(date('Y', strtotime($movie['release_date']))) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
                <p class="text-gray-600 dark:text-gray-300 text-nowrap">Nothing is in the Archive.</p>
        <?php endif ?>
    </div>
</div>
