<?php
// Connect to database
$conn = mysqli_connect('localhost:3306', 'Skillbuddy', '#45Vxt6b7', 'boydfranken_nl_');

// Validate and insert comment
$comment = $_POST['comment'];
// ... (validation logic)

$sql = "INSERT INTO comments (text) VALUES (?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $comment);
mysqli_stmt_execute($stmt);

// Send success or error response
echo json_encode(['success' => true]); // Or error message