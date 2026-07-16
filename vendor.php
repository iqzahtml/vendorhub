<?php

session_start();


if(!isset($_SESSION['user_id']))
{
    header("Location: ../index.php");
}


?>


<!DOCTYPE html>
<html>


<head>

<title>
Vendor Dashboard - VendorHub
</title>


<link rel="stylesheet" href="../css/style.css">


</head>


<body>



<header>


<div class="logo">
VendorHub Seller
</div>


<nav>

<a href="dashboard.php">
Dashboard
</a>


<a href="add_product.php">
Add Product
</a>


<a href="manage_delivery.php">
Delivery
</a>


<a href="../logout.php">
Logout
</a>


</nav>


</header>



<section class="hero">


<div class="hero-text">


<h1>

Welcome Vendor
<?php echo $_SESSION['name']; ?>

</h1>


<p>
Manage your products and delivery method.
</p>



</div>


</section>



<section class="category">


<h2>
Vendor Menu
</h2>



<div class="category-box">


<div>

<h3>
Add Product
</h3>

<p>
Upload your product
</p>


<a href="add_product.php">
Open
</a>


</div>



<div>

<h3>
Manage Delivery
</h3>

<p>
Set Pickup/Postage
</p>


<a href="manage_delivery.php">
Open
</a>


</div>



</div>


</section>



</body>


</html>