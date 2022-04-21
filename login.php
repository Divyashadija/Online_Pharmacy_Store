<?php
   $username = $_POST['username'];
   $password = $_POST['password'];

   //Database Connection
   $con = new mysqli('localhost','root','','online_store');
   if($con->connect_error){
       die('Connection Failed : '.$con->connect_error);
   }else{
       $stmt = $con->prepare("select * from register where username = ?");
       $stmt->bind_param("s",$username);
       $stmt->execute();
       $stmt_result = $stmt->get_result();
       if($stmt_result->num_rows > 0){
           $data = $stmt_result->fetch_assoc();
           if($data['password'] === $password){
               header('Location: http://localhost/Online_Pharmacy_Store/index.html');
               session_start();
               $_SESSION['loggedInUserID'] = $data['userName'];
           }else{
               echo "<h2>Invalid Email or Password</h2>";
           }
       }else{
           echo "<h2>Invalid Email or Password</h2>";
       }
   }
?>