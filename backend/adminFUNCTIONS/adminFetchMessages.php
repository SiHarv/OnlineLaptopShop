<?php
include '../../config/database.php';
session_start();

header('Content-Type: application/json'); // Set JSON header

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$admin_id = $_SESSION['user_id'];

// Fetch messages with user info
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $receiver_id = mysqli_real_escape_string($conn, $_GET['receiver_id']);
    $sql = "SELECT m.*, 
            CONCAT(u1.first_name, ' ', u1.last_name) as sender_name,
            CONCAT(u2.first_name, ' ', u2.last_name) as receiver_name
            FROM messages m
            JOIN users u1 ON m.sender_id = u1.user_id
            JOIN users u2 ON m.receiver_id = u2.user_id
            WHERE (m.sender_id = ? AND m.receiver_id = ?) 
            OR (m.sender_id = ? AND m.receiver_id = ?) 
            ORDER BY m.timestamp";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $admin_id, $receiver_id, $receiver_id, $admin_id);
    
    if (!mysqli_stmt_execute($stmt)) {
        echo json_encode(['error' => mysqli_error($conn)]);
        exit;
    }
    
    $result = mysqli_stmt_get_result($stmt);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($messages);
}

// Send message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
    $message_text = mysqli_real_escape_string($conn, $_POST['message_text']);
    
    $sql = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $admin_id, $receiver_id, $message_text);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>