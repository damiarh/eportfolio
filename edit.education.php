<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM education WHERE id=$id");
$edu = mysqli_fetch_assoc($result);
$message = "";

if (isset($_POST['update'])) {
    $school = mysqli_real_escape_string($conn, $_POST['school_name']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    if (!empty($school) && !empty($qualification) && !empty($year)) {
        mysqli_query($conn, "UPDATE education 
                             SET school_name='$school', qualification='$qualification', year='$year' 
                             WHERE id=$id");
        $message = "✅ Education record updated!";
        $result = mysqli_query($conn, "SELECT * FROM education WHERE id=$id");
        $edu = mysqli_fetch_assoc($result);
    } else {
        $message = "⚠️ Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Education</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Edit Education</h1>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>School/University:</label><br>
        <input type="text" name="school_name" value="<?php echo htmlspecialchars($edu['school_name']); ?>" required><br><br>

        <label>Qualification:</label><br>
        <input type="text" name="qualification" value="<?php echo htmlspecialchars($edu['qualification']); ?>" required><br><br>

        <label>Year:</label><br>
        <input type="text" name="year" value="<?php echo htmlspecialchars($edu['year']); ?>" required><br><br>

        <button type="submit" name="update">Update</button>
    </form>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../education.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
