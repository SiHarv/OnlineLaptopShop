<?php 

include '../../config/database.php';

$sql = "SELECT * FROM Products ORDER BY product_id DESC";
$run_sql = mysqli_query($conn, $sql);
$output = "";
if(mysqli_num_rows($run_sql) > 0){
    while($row = mysqli_fetch_assoc($run_sql)){
        $output .= "<tr>
        <td>{$row["name"]}</td>
        <td>{$row["description"]}</td>
        <td>{$row["price"]}</td>
        <td>{$row["stock"]}</td>
        <td><img src='../../uploads/{$row["image_url"]}' style='width:70px;height:70px;' /></td>
        <td><button data-id='{$row["product_id"]}' id='edit-images' class='btn btn-success' data-toggle='modal' data-target='#updateImage'>Edit</button></td>
        <td><button data-id='{$row["product_id"]}' id='delete-image' class='btn btn-danger'>Delete</button></td>
    </tr>";
    }
    echo $output;
}else{
    echo "<h1>Record Not Found</h1>";
}
?>