<?php require_once("../data/db.php") ?>

<div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 break-inside-avoid">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Add a New Movie</h2>

    <form action="add_movie.php" method="POST" enctype="multipart/form-data" class="space-y-6">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Movie Title</label>
            <input type="text" id="title" name="title" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100" 
                placeholder="Enter movie title" required>
        </div>

        <!-- Release Date -->
        <div>
            <label for="release_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Release Date</label>
            <input type="date" id="release_date" name="release_date" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100" 
                required>
        </div>

        <!-- Director -->
        <div>
            <label for="director" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Director</label>
            <input type="text" id="director" name="director" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100" 
                placeholder="Enter director's name" required>
        </div>

        <!-- Synopsis -->
        <div>
            <label for="synopsis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Synopsis</label>
            <textarea id="synopsis" name="synopsis" rows="4" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100" 
                placeholder="Enter movie synopsis" required></textarea>
        </div>

        <!-- Genre Selection -->
        <div>
            <label for="genres" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Genres</label>
            <select id="genres" name="genres[]" multiple 
                class="chosen-select w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100">
                <option value=""></option>
                <?php
                // Fetch genres from the database
                $stmt = $db -> prepare("SELECT * FROM genres");
                $stmt -> execute();

                $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                foreach ($rows as $row) {
                    echo '<option value="' . $row['genre_id'] . '">' . $row['name'] . '</option>';
                }                
                ?>
            </select>
        </div>

        <!-- Image Upload -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Movie Poster</label>
            <input type="file" id="image" name="image" accept="image/*" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100">
        </div>

        <!-- Submit Button -->
        <button type="submit" 
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add Movie
        </button>
    </form>
</div>
