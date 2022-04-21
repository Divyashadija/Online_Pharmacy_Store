<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="./../style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="logo">
            <a href="index.html"><img src="./../Images/Medicines/Logo.png" width = "125px" alt="Logo Image"></a>
        </div>
        <nav>
            <ul id="MenuItems">
                <li><a href="./../index.html">Home</a></li>
                <li><a href="./../products.html">Products</a></li>
                <li><a href="./../about.html">About</a></li>
                <li><a href="index.php">Contact Us</a></li>
                <li><a href="./../account.html">Account</a></li>
            </ul>
        </nav>
        <a href="./../cart.php"><img src="./../Images/Medicines/cart.png" width="30px" height="30px" color="ffd6d6"></a>
        <img src="Images/Medicines/menu.png" class="menu-icon" onclick="menutoggle()">
    </div>
 </div>
   <div class="contact-form">
   <h2>CONTACT US</h2>
   <form method ="post" action ="">
       <input type="text" name="name" placeholder="Your Name" required>
       <input type="text" name="phone" placeholder="Phone No" required>
       <input type="email" name="email" placeholder="Your Email" required>
       <textarea name="message" placeholder="Your Message" required></textarea>
       <div class="g-recaptcha" data-sitekey="6Le9VPMeAAAAANEWlIS9YaUEy00qBm5YjJeT3Vea"></div>
       <input type="submit" name="submit" value="Send Message" class="submit-btn">
    </form>
    <div class="status">
        <?php
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            require_once './../PHPMailer/src/PHPMailer.php';
            require_once './../PHPMailer/src/SMTP.php';
            require_once './../PHPMailer/src/Exception.php';
          
            if(isset($_POST['submit'])) {
                $mail = new PHPMailer();
                try {
                    $User_name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $user_email = $_POST['email'];
                    $user_message = $_POST['message'];
                    
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'divyashadija12402@gmail.com';
                    $mail->Password = 'DJune@15';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SMTPDebug = 0;
                    $mail->setFrom('divyashadija12402@gmail.com', $User_name);
                    $mail->addAddress('divyashadija12402@gmail.com', $User_name);
                    
                    $mail->addReplyTo('divyashadija12402@gmail.com', 'Information');
                    
                    $mail->isHTML(true);
                    $mail->Subject = 'Pharmacy Store Message';
                    $mail->Body = "NAME: ".$User_name
                                    ."<br>CONTACT: ".$phone
                                    ."<br>EMAIL: ".$user_email
                                    ."<br>MESSAGE: ".$user_message;
                    $mail->AltBody = "NAME: ".$User_name
                                    ."<br>CONTACT: ".$phone
                                    ."<br>EMAIL: ".$user_email
                                    ."<br>MESSAGE: ".$user_message;
                    if($mail->send()){
                        echo "Mail Sent Successfully!";    
                    } else {
                        echo "Mail Not Sent Successfully!";
                    }
                } catch (Throwable $th) {
                    echo "Something went Wrong, Mail not Sent";
                }
          }
        ?>
    </div>
    </div> 
</body>

<!-------------Footer------------->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Download our App</h3>
                <p>Download App for android and ios mobile phone.</p>
                <div class="app-logo">
                    <img src="./../Images/Medicines/play_store.png">
                    <img src="./../Images/Medicines/app_store.png" width="140" height="65">
                </div>
            </div>
            <div class="footer-col-2">
               <img src="./../Images/Medicines/Logo.png" width="120" height="85">
               <p>Our Purpose is to Sustainably Make the Pleasure and Benefits of Medicines Accessible to  the Many. </p>
           </div>
           <div class="footer-col-3">
               <h3>Useful Links</h3>
               <ul>
                   <li>Coupons</li>
                   <li>Blog Post</li>
                   <li>Return Policy</li>
                   <li>Join Affiliate</li>
               </ul>
           </div>
           <div class="footer-col-4">
               <h3>Follow us</h3>
               <ul>
                   <li>Facebook</li>
                   <li>Twitter</li>
                   <li>Instagram</li>
                   <li>YouTube</li>
               </ul>
           </div>
        </div>
        <hr>
        <p class="Copyright">copyright 2022 - Divya's Project</p>
    </div>
</div>
</html>