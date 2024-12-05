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

// Check if the post content is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
    // Clean up the content to avoid XSS attacks
    $content = htmlspecialchars($_POST['content']);
    
    // Prepare the SQL query to insert the post
    $sql = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
    
    // Bind the parameters and execute the query
    $data = array($user_id, $content);
    
    if (Database::executeQuery($sql, $data)) {
        // Post submitted successfully, redirect to the home page or forum page
        header("Location: home.php");
        exit();
    } else {
        echo "Error: Unable to submit the post.";
    }
}
?>
