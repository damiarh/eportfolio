<?php
include "includes/db_connect.php";
session_start();

// Fetch all activities
$sql = "SELECT * FROM activities ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Activities</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include "navbar.php"; ?> 
    <h1>My Activities</h1>
	
	<?php if (mysqli_num_rows($result) == 0) { ?>
        <p>No education records yet.</p>
    <?php } else { ?>
    <ul class="public-list">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <li>
    <span class="activity-title"><?php echo htmlspecialchars($row['title']); ?></span> 
    (<?php echo htmlspecialchars($row['date']); ?>) <br>
    <?php echo htmlspecialchars($row['description']); ?>
</li>
    <?php } ?>
</ul>
	<?php } ?>

    <?php if (isset($_SESSION['admin'])) { ?>
        <p><a href="admin/manage_activities.php">Manage Activities (Admin)</a></p>
    <?php } ?>
</body>
</html>


