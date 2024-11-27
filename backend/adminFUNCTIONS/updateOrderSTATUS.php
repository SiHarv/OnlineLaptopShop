<?php
session_start();
include '../../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Update Orders table only
        $orders_sql = "UPDATE Orders SET status = ? WHERE order_id = ?";
        $orders_stmt = $conn->prepare($orders_sql);
        $orders_stmt->bind_param("si", $status, $order_id);

        if ($orders_stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order status updated successfully']);
        } else {
            throw new Exception('Failed to update order status');
        }

        $orders_stmt->close();

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>