<?php
require_once("../data/db.php");

$query = "
        SELECT
        a.archived_data,
        u.username,
        m.title as movie_title,
        m.image_path,
        m.release_date
    FROM archives a
    INNER JOIN users u ON a.archived_by_user_id = u.user_id
    LEFT JOIN movies m ON JSON_UNQUOTE(JSON_EXTRACT(a.archived_data, '$.movie_id')) = m.movie_id
    WHERE JSON_EXTRACT(a.archived_data, '$.rating') IS NOT NULL  -- Reviews have ratings, movies don't
    AND JSON_EXTRACT(a.archived_data, '$.content') IS NOT NULL   -- Reviews have content, movies don't
    ORDER BY a.archived_at DESC
";
$stmt = $db->prepare($query);
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Archived Reviews</h2>
    <div class="reviews-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 cursor-pointer">
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <?php
                $data = json_decode($review['archived_data'], true);
                
                $title = htmlspecialchars($review['movie_title'] ?? 'Unknown Title');
                $imagePath = htmlspecialchars($review['image_path'] ?? '/path/to/your/placeholder.jpg');
                $releaseDate = !empty($review['release_date']) ? date('Y', strtotime($review['release_date'])) : 'Unknown Year';
                $rating = htmlspecialchars($data['rating'] ?? 'N/A');
                $reviewContent = htmlspecialchars($data['content'] ?? 'No content available');
                ?>
                <div class="border-2 rounded group relative bg-transparent overflow-hidden max-w-xs mx-auto">
                    <!-- Movie Poster -->
                    <div class="movie-image relative aspect-[2/3]">
                        <img src="<?= $imagePath ?>"
                                alt="<?= $title ?>"
                                class="w-full h-full object-cover rounded-sm border border-gray-700">

                        <div class="absolute inset-0 bg-black bg-opacity-75 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-sm text-center px-4"><?= $reviewContent ?></p>
                        </div>
                    </div>
                    <!-- Movie Title, Year, and Rating -->
                    <div class="border-t-2 p-2">
                        <h3 class="text-xs font-normal text-gray-200">
                            <?= $title ?>
                        </h3>
                        <p class="text-sm text-gray-500">
                            <?= $releaseDate ?>
                        </p>
                        <p class="text-sm text-yellow-400">
                            Rating: <?= $rating ?>/5
                        </p>
                        <p class="text-xs text-gray-400">
                            Reviewed by: <?= htmlspecialchars($review['username']) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600 dark:text-gray-300 text-nowrap">No archived reviews found.</p>
        <?php endif; ?>
    </div>
</div>