<?php
session_start();
include '../../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $totalAmount = $_POST['totalAmount'];
        $carrier = isset($_POST['carrier']) ? $_POST['carrier'] : null;
        $payment_option = $_POST['payment_option'];

        $sql = "INSERT INTO Orders (user_id, product_id, qty, total_amount, status, carrier, payment_option) VALUES (?, ?, ?, ?, 'Pending', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiidss", $user_id, $product_id, $qty, $totalAmount, $carrier, $payment_option);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order placed successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to place order']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>