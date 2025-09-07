<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_interests.php");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM interests WHERE id=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: manage_interests.php");
    exit;
}

$message = "";

// Handle Update
if (isset($_POST['update'])) {
    $interest_name = mysqli_real_escape_string($conn, $_POST['interest_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (!empty($interest_name) && !empty($description)) {
        $sql = "UPDATE interests 
                SET interest_name='$interest_name', description='$description' 
                WHERE id=$id";
        mysqli_query($conn, $sql);
        $message = "✅ Interest updated!";
        // Refresh data
        $result = mysqli_query($conn, "SELECT * FROM interests WHERE id=$id");
        $data = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Interest</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Edit Interest</h1>
    <?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Interest Name:</label><br>
        <input type="text" name="interest_name" value="<?php echo htmlspecialchars($data['interest_name']); ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required><?php echo htmlspecialchars($data['description']); ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
    </form>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../interests.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
