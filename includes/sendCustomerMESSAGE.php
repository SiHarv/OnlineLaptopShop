<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_email = $_POST['recipient_email'];
    $order_id = $_POST['order_id'];
    $message_content = $_POST['message_content'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $total_price = $_POST['total_price'];
    $payment_method = $_POST['payment_method'];
    $carrier = $_POST['carrier'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Harveycasane@gmail.com'; // Your Gmail
        $mail->Password = 'wrmq lhrf uxnu fgmv'; // Your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('Harveycasane@gmail.com', 'Online Laptop Shop');
        $mail->addAddress($recipient_email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Order #$order_id - Message from Online Laptop Shop";
        $mail->Body = "
            <div style='text-align: center;'>
                <h2>Message Regarding Order #$order_id</h2>
                <hr>
                <p>Product: $product</p>
                <p>Quantity: $quantity</p>
                <p>Unit Price: $unit_price</p>
                <p>Total Price: $total_price</p>
                <p>Payment Method: $payment_method</p>
                <p>Carrier: $carrier</p>
                <hr>
                <div style='text-align: left; margin: 20px; padding: 20px; border: 1px solid #ddd;'>
                    $message_content
                </div>
                <p>Thank you for shopping with Online Laptop Shop!</p>
            </div>";

        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";   
    }
}
?>