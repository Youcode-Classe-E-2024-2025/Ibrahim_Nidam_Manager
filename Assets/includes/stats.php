<?php
    require_once("user_count.php");
    require_once("movie_count.php");
    require_once("archive_count.php");
?>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 text-center">
        <h3 class="text-4xl font-bold text-blue-500"><?= $user_count; ?></h3>
        <p class="text-gray-600 dark:text-gray-300">Total Users</p>
    </div>
    <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 text-center">
        <h3 class="text-4xl font-bold text-green-500"><?= $movie_count; ?></h3>
        <p class="text-gray-600 dark:text-gray-300">Total Movies</p>
    </div>
    <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 text-center">
        <h3 class="text-4xl font-bold text-yellow-500"><?= $archive_count; ?></h3>
        <p class="text-gray-600 dark:text-gray-300">Archived Data</p>
    </div>
    <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 text-center">
        <h3 class="text-4xl font-bold text-red-500">1,234</h3>
        <p class="text-gray-600 dark:text-gray-300">Active Sessions</p>
    </div>
</div>