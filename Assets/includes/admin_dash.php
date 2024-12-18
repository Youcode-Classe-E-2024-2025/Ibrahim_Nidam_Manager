<?php
    require_once("../data/db.php");
    ?>

<?php require_once("header.php"); ?>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
    <div class="flex justify-between items-center p-6">
        <h1 class="text-2xl font-bold mb-6 underline">Dashboard</h1>
        <button id="theme-toggle" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
            <svg id="theme-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </button>
    </div>
    
    <div class="p-6">
        <!-- Statistics Section -->
        <?php require_once("stats.php"); ?>
        
        <!-- Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Activity Reports</h2>
                <p class="text-gray-600 dark:text-gray-300">Placeholder for recent activity logs and reports.</p>
            </div>
            <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">New Users</h2>
                <p class="text-gray-600 dark:text-gray-300">Placeholder for new user registrations.</p>
            </div>
            <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Movies</h2>
                <p class="text-gray-600 dark:text-gray-300">Placeholder for movie management tools.</p>
            </div>
            <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Add Movie</h2>
                <p class="text-gray-600 dark:text-gray-300">Placeholder for movie addition form.</p>
            </div>
            <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Trending NFTs</h2>
                <p class="text-gray-600 dark:text-gray-300">Placeholder for NFT trends and analytics.</p>
            </div>
            <div class="bg-white dark:bg-gray-700 shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Support Tickets</h2>
                <p class="text-gray-600 dark:text-gray-300">Placeholder for customer support ticket overview.</p>
            </div>
        </div>
    </div>

    <script src="../js/app.js"></script>
</body>

</html>