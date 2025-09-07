<?php
session_start();
include "includes/db_connect.php";

// Fetch all interests
$sql = "SELECT * FROM interests ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Interests</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <h1>My Interests</h1>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <p>No interests added yet.</p>
    <?php } else { ?>
        <ul class="public-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <strong><?php echo htmlspecialchars($row['interest_name']); ?></strong><br>
                <?php echo htmlspecialchars($row['description']); ?>
            </li>
        <?php } ?>
        </ul>
    <?php } ?>

    <p><a href="admin/manage_interests.php">Manage Interests (Admin)</a></p>
</body>
</html>
