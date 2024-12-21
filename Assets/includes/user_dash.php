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
        WHERE m.is_active = TRUE
        GROUP BY m.movie_id
    ";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $user_id = "user"; 
    $reviewsQuery = "
        SELECT r.review_id, r.content, r.rating, m.title AS movie_title
        FROM reviews r
        JOIN movies m ON r.movie_id = m.movie_id
        WHERE r.user_id = :user_id
    ";
    $reviewsStmt = $db->prepare($reviewsQuery);
    $reviewsStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $reviewsStmt->execute();
    $reviews = $reviewsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">
    <header class="bg-gray-800 p-4 shadow-lg flex justify-between">
        <h1 class="text-2xl font-slim text-center underline">Stream Master</h1>
        <div class="flex gap-6 items-center">
            <button class="bg-gray-700 border-2 border-white text-white py-1 px-3 rounded shadow-lg transition-all cursor-pointer">
                WatchList
            </button>
            <button class="bg-gray-700 border-2 border-white text-white py-1 px-3 rounded shadow-lg transition-all cursor-pointer" onclick="toggleSidebar()">
                Reviews
            </button>
            <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
        </div>
    </header>

    <main class="container mx-auto py-8 px-4">
        <section class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6">
            <div class="movies-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php if(!empty($movies)): ?>
                    <?php foreach ($movies as $movie): ?>
                        <div class=" rounded group relative bg-transparent overflow-hidden">
                            <div class="movie-image border-4 rounded relative aspect-[2/3]">
                                <img src="<?= htmlspecialchars($movie['image_path']) ?>"
                                        alt="<?= htmlspecialchars($movie['title']) ?>"
                                        class="w-full h-full object-cover rounded-sm border border-gray-700">
                                <div class="absolute inset-0 bg-black bg-opacity-75 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-sm text-center px-4"><?= htmlspecialchars($movie['genres']) ?></p>
                                </div>
                            </div>
                            <div class=" p-2">
                                <h3 class="text-sm font-semibold text-gray-200"><?= htmlspecialchars($movie['title']) ?></h3>
                                <p class="text-xs text-gray-500"><?= htmlspecialchars(date('Y', strtotime($movie['release_date']))) ?></p>
                            </div>
                            <div class="flex flex-col gap-2 mt-2">
                                <button class="w-full bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 hover:from-yellow-500 hover:to-pink-500 text-white py-1 px-3 rounded shadow-lg transition-all">
                                    Watch Later
                                </button>
                                <button 
                                    class="w-full bg-gradient-to-r from-green-500 to-blue-500 hover:from-blue-500 hover:to-green-500 text-white py-1 px-3 rounded shadow-lg transition-all"
                                    onclick="openReviewModal('<?= htmlspecialchars($movie['movie_id']) ?>')">
                                    Review Movie
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-600 dark:text-gray-300 text-nowrap">No Movies Added Yet.</p>
                <?php endif ?>
            </div>
        </section>

        <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-gray-500 p-6 rounded w-96">
                <h3 class="text-xl font-semibold mb-4">Write Your Review</h3>
                <form id="reviewForm" method="POST" action="submit_review.php" class="text-black">
                    <input type="hidden" name="movie_id" id="movie_id">
                    <textarea name="review_content" rows="4" class="w-full p-2 border rounded mb-4" placeholder="Write your review here..."></textarea>
                    <label for="rating" class="block text-sm mb-2">Rating (1-5):</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" class="w-full p-2 border rounded mb-4">
                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit Review</button>
                </form>
                <button onclick="closeReviewModal()" class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
            </div>
        </div>

        <!-- Sidebar for reviews -->
        <div id="reviewSidebar" class="fixed inset-0 bg-black bg-opacity-50 flex justify-end items-start hidden">
            <div class="bg-white text-black w-80 p-6 h-full overflow-y-auto">
                <h3 class="text-xl font-semibold mb-4">Your Reviews</h3>
                <div id="reviewsList">
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="mb-4">
                                <h4 class="text-lg font-semibold"><?= htmlspecialchars($review['movie_title']) ?></h4>
                                <p class="text-sm text-gray-600"><?= htmlspecialchars($review['content']) ?></p>
                                <p class="text-xs text-yellow-500">Rating: <?= htmlspecialchars($review['rating']) ?>/5</p>
                                <a href="remove_review.php?review_id=<?= urlencode($review['review_id']) ?>" class="text-red-500 text-xs">Remove</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-600">You haven't written any reviews yet.</p>
                    <?php endif; ?>
                </div>
                <button onclick="toggleSidebar()" class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-center py-4">
        <p class="text-sm text-gray-400">© 2024 Stream Master. All rights reserved.</p>
    </footer>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('reviewSidebar');
        sidebar.classList.toggle('hidden');
    }

    function openReviewModal(movieId) {
        document.getElementById('movie_id').value = movieId;
        document.getElementById('reviewModal').classList.remove('hidden');
        document.getElementById('reviewForm').reset();
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        document.getElementById('reviewForm').reset();
    }
</script>
</body>
</html>
