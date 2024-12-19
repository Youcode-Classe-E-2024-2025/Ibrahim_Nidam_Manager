<?php 

    require_once("../data/db.php");

    $stmt = $db -> prepare("SELECT user_id ,username, email, is_active FROM users WHERE is_active = FALSE");
    $stmt -> execute();

    $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

?>

<div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 break-inside-avoid">
    <h2 class="text-xl font-semibold mb-4">New users Waiting Approval : </h2>
    <?php if(!empty($rows)): ?>
        <?php foreach($rows as $row): ?>
        <div class="flex justify-between">
            <p class="text-gray-600 dark:text-gray-300"><?php echo htmlspecialchars($row["username"]); ?></p>
            <p class="text-gray-600 dark:text-gray-300"><?php echo htmlspecialchars($row["email"]); ?></p>
            <a class="underline hover:text-[#7d2ae8]" href="approve.php?user_id=<?= $row["user_id"]; ?>">Approve</a>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-600 dark:text-gray-300">No New Applicants.</p>
    <?php endif ?>
</div>