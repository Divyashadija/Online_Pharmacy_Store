<?php
include_once './admin/includes/db.inc.php';
include_once './admin/includes/head.php';
session_start();

$userID = $_SESSION['loggedInUserID'];
$productID = $_POST['productID'];
$action = $_POST['action'];
if($action == "add") {
    $sql="insert into cart(userName,productID) values('$userID','$productID')";
} elseif($action == "delete"){
    $sql="delete from cart where cart_id = '$productID'";
}
$query=mysqli_query($conn,$sql);
if($query){
    echo"1 row inserted";
}else{
    echo mysqli_error($conn);
}
?>