<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("/eportfolio/images/bg.jpg");
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: url("/eportfolio/images/bg2.jpg");
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #3CB371;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #3CB371;
        }
        .menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 30px;
        }
        .menu a {
            display: block;
            background: #DB7093; 
            color: white;
            text-decoration: none;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .menu a:hover {
            background: #3CB371;
        }
        .logout {
            margin-top: 30px;
            text-align: center;
        }
        .logout a {
            color: white;
            background: #DB7093;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }
        .logout a:hover {
            background: #3CB371;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <b><?php echo htmlspecialchars($_SESSION['admin']); ?></b>! Manage your e-Portfolio:</p>

        <div class="menu">
            <a href="edit_about.php">Edit About Me</a>
            <a href="manage_activities.php">Manage Activities</a>
            <a href="manage_education.php">Manage Education</a>
            <a href="manage_qualification.php">Manage Qualifications</a>
            <a href="manage_interests.php">Manage Interests</a>
        </div>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
