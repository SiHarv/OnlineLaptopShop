<?php
include '../../config/database.php';

$sql = "SELECT * FROM Laptops";
$result = mysqli_query($conn, $sql);
$laptops = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $laptops[] = $row;
    }
}

echo json_encode($laptops);
?>