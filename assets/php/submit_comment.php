<?php
// Connect to database
$conn = mysqli_connect('localhost:3306', 'Skillbuddy', '#45Vxt6b7', 'boydfranken_nl_');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and insert comment
$comment = $_POST['comment'];
// ... (validation logic)

$sql = "INSERT INTO comments (text) VALUES (?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 's', $comment);

if (!mysqli_stmt_execute($stmt)) {
    die("Error executing query: " . mysqli_stmt_error($stmt));
}

echo json_encode(['success' => true]);

mysqli_stmt_close($stmt);
mysqli_close($conn);