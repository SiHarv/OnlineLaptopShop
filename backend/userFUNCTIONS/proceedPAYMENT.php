<?php
session_start();
include '../../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start transaction
        $conn->begin_transaction();

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $totalAmount = $_POST['totalAmount'];
        $carrier = isset($_POST['carrier']) ? $_POST['carrier'] : null;
        $payment_option = $_POST['payment_option'];

        // First insert into Orders table
        $sql = "INSERT INTO Orders (user_id, product_id, qty, total_amount, status, carrier, payment_option) 
                VALUES (?, ?, ?, ?, 'Pending', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiidss", $user_id, $product_id, $qty, $totalAmount, $carrier, $payment_option);

        if ($stmt->execute()) {
            // Get the last inserted order_id
            $order_id = $conn->insert_id;

            // Get the product price
            $price_sql = "SELECT price FROM products WHERE product_id = ?";
            $price_stmt = $conn->prepare($price_sql);
            $price_stmt->bind_param("i", $product_id);
            $price_stmt->execute();
            $price_result = $price_stmt->get_result();
            $price_row = $price_result->fetch_assoc();
            $product_price = $price_row['price'];

            // Insert into allorder table
            $allorder_sql = "INSERT INTO allorder (user_id, order_id, product_id, quantity, price) 
                           VALUES (?, ?, ?, ?, ?)";
            $allorder_stmt = $conn->prepare($allorder_sql);
            $allorder_stmt->bind_param("iiiid", $user_id, $order_id, $product_id, $qty, $product_price);
            
            if ($allorder_stmt->execute()) {
                $conn->commit();
                echo json_encode(['status' => 'success', 'message' => 'Order placed successfully']);
            } else {
                throw new Exception('Failed to insert into allorder table');
            }

            $allorder_stmt->close();
            $price_stmt->close();
        } else {
            throw new Exception('Failed to insert into Orders table');
        }

        $stmt->close();

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>