<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

// Handle Add
if (isset($_POST['add'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    if (!empty($title) && !empty($description) && !empty($date)) {
        $sql = "INSERT INTO activities (title, description, date) VALUES ('$title','$description','$date')";
        mysqli_query($conn, $sql);
        $message = "✅ Activity added!";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM activities WHERE id=$id");
    $message = "🗑️ Activity deleted!";
}

// Fetch
$result = mysqli_query($conn, "SELECT * FROM activities ORDER BY date DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Activities</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Activities</h1>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>
        <label>Date:</label><br>
        <input type="date" name="date" required><br><br>
        <button type="submit" name="add">Add Activity</button>
    </form>

    <hr>
    <h2>Existing Activities</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <b><?php echo htmlspecialchars($row['title']); ?></b>
                (<?php echo htmlspecialchars($row['date']); ?>)<br>
                <?php echo htmlspecialchars($row['description']); ?><br>
                <a href="edit_activity.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="manage_activities.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this activity?');">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../activities.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>

