<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

$message = "";

// Add Interest
if (isset($_POST['add'])) {
    $interest = mysqli_real_escape_string($conn, $_POST['interest_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (!empty($interest) && !empty($description)) {
        mysqli_query($conn, "INSERT INTO interests (interest_name, description) VALUES ('$interest','$description')");
        $message = "✅ Interest added!";
    } else {
        $message = "⚠️ Please fill in all fields.";
    }
}

// Delete Interest
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM interests WHERE id=$id");
    $message = "🗑️ Interest deleted!";
}

// Fetch Interests
$result = mysqli_query($conn, "SELECT * FROM interests ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Interests</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Interests</h1>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Interest:</label><br>
        <input type="text" name="interest_name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>

        <button type="submit" name="add">Add Interest</button>
    </form>

    <hr>
    <h2>Existing Interests</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <b><?php echo htmlspecialchars($row['interest_name']); ?></b><br>
                <?php echo htmlspecialchars($row['description']); ?><br>
                <a href="edit_interest.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="manage_interests.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this interest?');">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../interests.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
