<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html>

<head>

<title>VendorHub Catalog</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<header>

<div class="logo">
VendorHub
</div>


<nav>

<a href="index.php">
Home
</a>

<a href="catalog.php">
Catalog
</a>

<a href="logout.php">
Logout
</a>

</nav>


</header>



<section class="category">


<h1>
Choose Category
</h1>


<div class="category-box">


<div>

<h3>
🍔 Food
</h3>

<p>
Food and beverages
</p>

<a href="product.php?category=Food">

<button>
View
</button>

</a>

</div>



<div>

<h3>
👕 Fashion
</h3>

<p>
Clothes and accessories
</p>


<a href="product.php?category=Fashion">

<button>
View
</button>

</a>


</div>




<div>

<h3>
💄 Beauty
</h3>

<p>
Beauty products
</p>


<a href="product.php?category=Beauty">

<button>
View
</button>

</a>


</div>




<div>

<h3>
💻 Electronics
</h3>

<p>
Electronic products
</p>


<a href="product.php?category=Electronics">

<button>
View
</button>

</a>


</div>



<div>

<h3>
🛠 Services
</h3>

<p>
Various services
</p>


<a href="product.php?category=Services">

<button>
View
</button>

</a>


</div>



</div>


</section>



</body>

</html>