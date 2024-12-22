
<?php require_once("header.php"); ?>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
    <div class="flex justify-between items-center p-6">
        <h1 class="text-2xl font-bold mb-6 underline">Dashboard</h1>
        <a href="../../index.php">
                <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
        </a>
    </div>
    
    <div class="p-6">
        <!-- Statistics Section -->
        <?php require_once("stats.php"); ?>
        
        <!-- Cards Section -->
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6 mb-6">
            <!-- Approve Users -->
            <?php require_once("approve_users.php"); ?>

            <!-- Manage User Role -->
            <?php require_once("manage_user_role.php"); ?>

            <!-- Add Movies -->
            <?php require_once("movie_html.php"); ?>
            
            <!-- Display Movie -->
            <?php require_once("display_movie.php"); ?>
            
        </div>
            <!-- Archived Movies -->
            <?php require_once("archived_movies.php"); ?>
            
            <!-- Archived Reviews -->
            <?php require_once("archived_reviews.php"); ?>
    </div>


    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    </script>
    <script src="../js/app.js"></script>
</body>

</html>