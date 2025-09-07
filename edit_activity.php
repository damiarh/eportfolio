<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM activities WHERE id=$id");
$activity = mysqli_fetch_assoc($result);
$message = "";

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    if (!empty($title) && !empty($description) && !empty($date)) {
        mysqli_query($conn, "UPDATE activities SET title='$title', description='$description', date='$date' WHERE id=$id");
        $message = "✅ Activity updated!";
        $result = mysqli_query($conn, "SELECT * FROM activities WHERE id=$id");
        $activity = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Activity</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Edit Activity</h1>
    <?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($activity['title']); ?>" required><br><br>
        <label>Description:</label><br>
        <textarea name="description" required><?php echo htmlspecialchars($activity['description']); ?></textarea><br><br>
        <label>Date:</label><br>
        <input type="date" name="date" value="<?php echo htmlspecialchars($activity['date']); ?>" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../activities.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
