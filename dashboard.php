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

<title>Customer Dashboard - VendorHub</title>

<link rel="stylesheet" href="../css/style.css">

</head>


<body>


<header>

<div class="logo">
VendorHub
</div>


<nav>

<a href="dashboard.php">
Home
</a>

<a href="#">
Products
</a>

<a href="../logout.php">
Logout
</a>


</nav>


</header>



<section class="hero">


<div class="hero-text">

<h1>
Welcome 
<?php echo $_SESSION['name']; ?>
</h1>


<p>
Find your favourite products from local vendors.
</p>


<button>
View Product
</button>


</div>


</section>



<section class="category">


<h2>
Available Products
</h2>



<div class="category-box">


<div>

<h3>
Food
</h3>

<p>
Homemade food from vendors
</p>

</div>



<div>

<h3>
Fashion
</h3>

<p>
Latest fashion items
</p>

</div>



<div>

<h3>
Services
</h3>

<p>
Professional services
</p>

</div>



</div>


</section>



</body>

</html>