<?php
include "includes/db_connect.php";
session_start();

// Fetch all education entries
$sql = "SELECT * FROM education ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Education</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <h1>My Education</h1>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <p>No education records yet.</p>
    <?php } else { ?>
        <ul class="public-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <strong><?php echo htmlspecialchars($row['school_name']); ?></strong><br>
                Qualification: <?php echo htmlspecialchars($row['qualification']); ?><br>
                Year: <?php echo htmlspecialchars($row['year']); ?>
            </li>
        <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($_SESSION['admin'])) { ?>
        <p><a href="admin/manage_education.php">Manage Education (Admin)</a></p>
    <?php } ?>
</body>
</html>
