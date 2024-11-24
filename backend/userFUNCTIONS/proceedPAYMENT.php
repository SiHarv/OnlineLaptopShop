<?php
session_start();
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $total_amount = $_POST['total_amount'];
    $carrier = isset($_POST['carrier']) ? $_POST['carrier'] : null;
    $payment_option = $_POST['payment_option'];

    $sql = "INSERT INTO Orders (user_id, total_amount, status, carrier, payment_option) VALUES (?, ?, 'Pending', ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idss", $user_id, $total_amount, $carrier, $payment_option);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Order placed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to place order']);
    }

    $stmt->close();
    $conn->close();
}
?>