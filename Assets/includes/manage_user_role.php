<?php 

    require_once("../data/db.php");

    $stmt = $db -> prepare("SELECT * FROM users u JOIN roles r ON u.role_id = r.role_id WHERE r.role_id != 'admin' AND u.is_active != FALSE");
    $stmt -> execute();

    $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);


?>

<div class="bg-white dark:bg-gray-700 shadow-md rounded p-6 break-inside-avoid">
    <h2 class="text-xl font-semibold mb-4">Manage Roles</h2>

    <?php if(!empty($rows)): ?>
    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600 text-left">
        <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
                <th class="border border-gray-300 dark:border-gray-600 p-2 text-gray-600 dark:text-gray-300">Email</th>
                <th class="border border-gray-300 dark:border-gray-600 p-2 text-gray-600 dark:text-gray-300">Username</th>
                <th class="border border-gray-300 dark:border-gray-600 p-2 text-gray-600 dark:text-gray-300">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-700 dark:even:bg-gray-600">
                    <td class="border border-gray-300 dark:border-gray-600 p-2 text-gray-600 dark:text-gray-300">
                        <?= htmlspecialchars($row["email"]) ?>
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 p-2 text-gray-600 dark:text-gray-300">
                        <?= htmlspecialchars($row["username"]) ?>
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 p-2">
                        <a class="underline hover:text-[#7d2ae8] hover:uppercase" href="switch_role.php?role_id=<?= $row["role_id"]; ?>">
                            <?= htmlspecialchars($row["role"]) ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-gray-600 dark:text-gray-300">No users found (excluding Admins).</p>
    <?php endif ?>

</div>