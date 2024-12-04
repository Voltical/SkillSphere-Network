<?php
session_start();
include("database.inc.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM user WHERE id = ?";
$data = array($user_id);
$result = Database::getData($sql, $data);

if (!empty($result)) {
    $user = $result[0]; // User details
    
    // Create a username using fname and lname with capitalized first letters
    $first_name = ucfirst(strtolower($user['fname'])); // Lowercase all, then capitalize first letter
    $last_name = ucfirst(strtolower($user['lname']));  // Lowercase all, then capitalize first letter
    $username = $first_name . ' ' . $last_name; // Combine first name and last name with a space
} else {
    echo "<p>User not found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SkillBuddy</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="icon" href="../images/favicon-32x32-circle.png">
</head>
<body>
	<div class="background">
    	<div class="dashboard-container">
        	<h1>Welcome to your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>

        		<div class="profile-picture">
           		 <?php
           		 if ($user['profile_picture']) {
          	      echo "<img src='" . htmlspecialchars($user['profile_picture']) . "' alt='Profile Picture' />";
          	 	 } else {
          	     echo "<img src='../images/jp_balkenende.jpg' alt='Default Profile Picture' />";
          		 }
          		 ?>
        </div>
        
        <div class="dashboard-details">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Joined on:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
        </div>

        <div class="dashboard-actions">
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
	</div>
</body>
</html>
