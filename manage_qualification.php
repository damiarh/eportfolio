<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

// Add Qualification
if (isset($_POST['add'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $institution = mysqli_real_escape_string($conn, $_POST['institution']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    if ($title && $institution && $year) {
        mysqli_query($conn, "INSERT INTO qualifications (title, institution, year) VALUES ('$title','$institution','$year')");
        $message = "✅ Qualification added!";
    }
}

// Delete Qualification
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM qualifications WHERE id=$id");
    $message = "🗑️ Qualification deleted!";
}

// Fetch Qualifications
$result = mysqli_query($conn, "SELECT * FROM qualifications ORDER BY year DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Qualifications</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Qualifications</h1>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        <label>Institution:</label><br>
        <input type="text" name="institution" required><br><br>
        <label>Year:</label><br>
        <input type="text" name="year" required><br><br>
        <button type="submit" name="add">Add Qualification</button>
    </form>

    <hr>
    <h2>Existing Qualifications</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <b><?php echo htmlspecialchars($row['title']); ?></b> - 
                <?php echo htmlspecialchars($row['institution']); ?> (<?php echo htmlspecialchars($row['year']); ?>)<br>
                <a href="edit_qualification.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="manage_qualification.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?');">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../qualification.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
