<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>VendorHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- Header -->
<header>
    <div class="logo">
        VendorHub
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="#">Product</a>
        <a href="#">Vendor</a>
        <a href="#">About</a>
    </nav>
</header>


<!-- Hero Section -->
<section class="hero">

    <div class="hero-text">
        <h1>Welcome to VendorHub</h1>

        <p>
            Discover products from local vendors easily.
            Support small businesses in one platform.
        </p>

        <button onclick="openLogin()">
            Start Shopping
        </button>

    </div>

</section>


<!-- Category Section -->
<section class="category">

<h2>Categories</h2>

<div class="category-box">

    <div>
        <h3>Food</h3>
        <p>Delicious homemade food</p>
    </div>

    <div>
        <h3>Fashion</h3>
        <p>Trendy products</p>
    </div>

    <div>
        <h3>Services</h3>
        <p>Various services</p>
    </div>

</div>

</section>


<!-- Login Popup -->

<div id="loginPopup" class="popup">

<div class="popup-content">

<span onclick="closeLogin()" class="close">
&times;
</span>


<h2>Login</h2>


<form action="login.php" method="POST">

<label>Email</label>
<input type="email" name="email" required>


<label>Password</label>
<input type="password" name="password" required>


<button type="submit">
Login
</button>

</form>


<p>
Don't have account?
<a href="register.php">
Register
</a>
</p>


</div>

</div>



<script>


// automatically show popup when page open

window.onload = function()
{
    document.getElementById("loginPopup").style.display="block";
}



function openLogin()
{
    document.getElementById("loginPopup").style.display="block";
}


function closeLogin()
{
    document.getElementById("loginPopup").style.display="none";
}


</script>


</body>
</html>