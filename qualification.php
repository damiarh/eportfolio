<?php
include "includes/db_connect.php";
session_start();

// Fetch all qualifications
$sql = "SELECT * FROM qualifications ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Qualifications</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <h1>My Qualifications</h1>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <p>No qualifications added yet.</p>
    <?php } else { ?>
        <ul class="public-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                Institution: <?php echo htmlspecialchars($row['institution']); ?><br>
                Year: <?php echo htmlspecialchars($row['year']); ?>
            </li>
        <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($_SESSION['admin'])) { ?>
        <p><a href="admin/manage_qualification.php">Manage Qualifications (Admin)</a></p>
    <?php } ?>
</body>
</html>
