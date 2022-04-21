<?php
   $username = $_POST['username'];
   $email = $_POST['email'];
   $contactNumber = $_POST['contactNumber'];
   $address = $_POST['address'];
   $password = $_POST['password'];

   //Database Connection
   $conn = new mysqli('localhost','root','','online_store');
   if($conn->connect_error){
       die('Connection Failed : '.$conn->connect_error);
   }else{
       $stmt = $conn->prepare("insert into register(username,email,contactNumber,address,password)values(?,?,?,?,?)");
       $stmt->bind_param("ssiss",$username,$email,$contactNumber,$address,$password);
       $stmt->execute();
       echo "Registration Successful..";
       $stmt->close();
       $conn->close();
   }
?>