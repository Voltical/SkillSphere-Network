<?php
// Connect to database
$conn = mysqli_connect('localhost:3306', 'Skillbuddy', '#45Vxt6b7', 'boydfranken_nl_');

// Fetch comments
$sql = "SELECT text FROM Comments";
$result = mysqli_query($conn, $sql);

$comments = [];
while ($row = mysqli_fetch_assoc($result)) {
  $comments[] = $row;
}

echo json_encode($comments);