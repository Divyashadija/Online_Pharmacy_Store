<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Online Pharmacy Store</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <?php 
        include_once './admin/includes/db.inc.php';
        include_once './admin/includes/head.php';
        session_start();
        $userID = $_SESSION['loggedInUserID'];
    ?>
</head>
<body></body>
<div class="container">
    <div class="navbar">
        <div class="logo">
            <a href="index.html"><img src="Images/Medicines/Logo.png" width = "125px" alt="Logo Image"></a>
        </div>
        <nav>
            <ul id="MenuItems">
                <li><a href="index.html">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact/index.php">Contact Us</a></li>
                <li><a href="account.html">Account</a></li>
            </ul>
        </nav>
        <a href="cart.php"><img src="Images/Medicines/cart.png" width="30px" height="30px" color="ffd6d6"></a>
        <img src="Images/Medicines/menu.png" class="menu-icon" onclick="menutoggle()">
    </div>
 </div>

        <div class="small-container">
            <h2>All Products</h2>
            <div class="row">
            <?php
            $sql = "select * from items;";
            $res = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($res);
            if($rescheck > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<div class="col-4">';
                    echo '<a"><img src="Images/Medicines/'.$row['img'].'"></a>';
                    echo '<a><h4>'.$row['name'].'</h4></a>';
                    echo '<div class="col-2">';
                    echo '<p>Rs '.$row['price'].'</p>';
                    echo '<a href="" class="btn cartbtn" width="8" height="8" onclick="addtoCart('.$row['id'].')">Add to Cart &#8594</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
                <!--<div class="col-4">
                    <img src="Images/Medicines/Soframycin.png">
                    <h4>Soframycin Cream</h4>
                    <div class="col-2">
                        <p>Rs.94.00</p>
                        <a href="" class="btn" width="8" height="8">Add to Cart &#8594</a>
                    </div>
                </div>-->
            </div> 
            </div>
        </div>
<!-------------Footer------------->
     <div class="footer">
         <div class="container">
             <div class="row">
                 <div class="footer-col-1">
                     <h3>Download our App</h3>
                     <p>Download App for android and ios mobile phone.</p>
                     <div class="app-logo">
                         <img src="Images/Medicines/play_store.png">
                         <img src="Images/Medicines/app_store.png" width="140" height="65">
                     </div>
                 </div>
                 <div class="footer-col-2">
                    <img src="Images/Medicines/Logo.png" width="120" height="85">
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
<!---------- js for toggle menu --------->
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px"){
                MenuItems.style.maxHeight = "200px"
            }
            else{
                MenuItems.style.maxHeight = "0px"
            }
        }

        function addtoCart(productID) {
            $.ajax({
                url: 'manage_cart.php',
                type: 'post',
                data: 'productID='+productID+'&action=add',
                success:function(result){
                    alert("Added to Cart");
                }
            });
        }

    </script>
</body>
</html>