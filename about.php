<?php
include "includes/db_connect.php";
session_start();

// Fetch About Me data (only 1 row for now)
$sql = "SELECT * FROM about_me LIMIT 1";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>About Me</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include "navbar.php"; ?> 

    <h1>About Me</h1>

    <div class="about-container">
    <img src="images/profile.jpg" alt="Profile Picture" class="profile-pic">
    <div class="about-text">
        <p><b>Name:</b> <?php echo htmlspecialchars($data['name']); ?></p>
        <p><b>Email:</b> 
            <a href="mailto:<?php echo htmlspecialchars($data['email']); ?>" target="_blank">
                <?php echo htmlspecialchars($data['email']); ?>
            </a>
        </p>
        <p><b>Description:</b> <?php echo htmlspecialchars($data['description']); ?></p>
    </div>
</div>

    <?php if (isset($_SESSION['admin'])) { ?>
        <p style="text-align:center;">
            <a href="admin/edit_about.php">Edit About Me</a>
        </p>
    <?php } ?>

    <?php include "includes/footer.php"; ?>
</body>
</html>




