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
<body>

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
 <!---------Cart Items Details------->

    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Products</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $sql = "SELECT i.img, i.name, i.price, c.cart_id, c.userName FROM items i INNER JOIN cart c ON i.id = c.productID;";
            $res = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($res);
            if($rescheck > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if($row['userName'] == $userID) {
                        echo '<tr>';
                        echo '<td>';
                        echo '<div class="cart-info">';
                        echo '<img src="Images/Medicines/'.$row['img'].'">';
                        echo '<div>';
                        echo '<p>'.$row['name'].'</p>';
                        echo '<small>Price: Rs '.$row['price'].'</small>';
                        echo '<br>';
                        echo '<a href="" onclick="deleteFromCart('.$row['cart_id'].')">Remove</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td><input type="number" min="1" value="1" onchange="calcItemTotal(this.value,'.$row['price'].','.$row['cart_id'].', '.$rescheck.')"></td>';
                        echo '<td>Rs. <input class = "price" id = "price'.$row['cart_id'].'" value="'.$row['price'].'" disabled></td>';
                        echo '</tr>';
                    }
                }
            }
            ?>
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>subtotal</td>
                    <td id = "subtotal"></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td id = "tax"></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td id = "total"></td>
                </tr>
            </table>
        </div>
        <div>
            <a href="Paytm_PHP/Paytm_PHP_Sample-master/PaytmKit/TxnTest.php" class="btn">Proceed to Checkout &#8594</a>
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
        window.onload = calcTotal();
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

        function calcItemTotal(quantity, price, cartId, noOfItems) {
            var s= document.getElementById('price'+cartId);
            s.value = quantity * price;
            calcTotal();
        }

        function calcTotal() {
            subTotalPrice = 0;
            tax = 0;
            allPrices = document.getElementsByClassName("price");
            for (let index = 0; index < allPrices.length; index++) {
                subTotalPrice = subTotalPrice + parseInt(allPrices[index].value);
            }
            tax = Math.round(subTotalPrice * 0.05);
            document.getElementById('subtotal').innerHTML = "Rs. " + subTotalPrice;
            document.getElementById('tax').innerHTML = "Rs. " + tax;
            document.getElementById('total').innerHTML = "Rs. " + (subTotalPrice + tax);
        }

            function deleteFromCart(cartID) {
                $.ajax({
                    url: 'manage_cart.php',
                    type: 'post',
                    data: 'productID='+cartID+'&action=delete',
                    success:function(result){
                        alert("Removed from Cart");
                    }
                });
            }
    </script>
</body>
</html>