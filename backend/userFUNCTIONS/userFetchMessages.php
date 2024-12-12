<?php
include '../../config/database.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $receiver_id = mysqli_real_escape_string($conn, $_GET['receiver_id']);
    $sql = "SELECT m.*, CONCAT(u.first_name, ' ', u.last_name) as sender_name 
            FROM messages m 
            JOIN users u ON m.sender_id = u.user_id 
            WHERE (m.sender_id = ? AND m.receiver_id = ?) 
            OR (m.sender_id = ? AND m.receiver_id = ?) 
            ORDER BY m.timestamp";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $user_id, $receiver_id, $receiver_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($messages);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
    $message_text = mysqli_real_escape_string($conn, $_POST['message_text']);
    
    $sql = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $user_id, $receiver_id, $message_text);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>