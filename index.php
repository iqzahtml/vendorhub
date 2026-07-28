<?php

include 'includes/header.php';
include 'includes/navbar.php';

?>

<section class="hero">

<div class="hero-content">

<h1>

Welcome to <span>HochipoHub</span>

</h1>

<p>

Malaysia's Student Marketplace

</p>

<div class="hero-button">

<a href="catalog.php" class="primary-btn">

Shop Now

</a>

<a href="vendor.php" class="secondary-btn">

Become Vendor

</a>

</div>

</div>

<div class="hero-image">

<img src="images/banner.jpg">

</div>

</section>


<section class="category-section">

<h2>

Popular Categories

</h2>

<div class="category-grid">

<div class="category-card">

<i class="fa-solid fa-burger"></i>

Food

</div>

<div class="category-card">

<i class="fa-solid fa-shirt"></i>

Fashion

</div>

<div class="category-card">

<i class="fa-solid fa-book"></i>

Stationery

</div>

<div class="category-card">

<i class="fa-solid fa-laptop"></i>

Electronics

</div>

<div class="category-card">

<i class="fa-solid fa-gift"></i>

Gift

</div>

<div class="category-card">

<i class="fa-solid fa-box"></i>

Others

</div>

</div>

</section>



<section class="featured">

<h2>

Featured Products

</h2>

<div class="product-grid">

<?php

$sql="SELECT * FROM products LIMIT 8";

$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))

{

?>

<div class="product-card">

<img src="uploads/products/<?php echo $row['image']; ?>">

<h3>

<?php echo $row['product_name']; ?>

</h3>

<p>

RM <?php echo number_format($row['price'],2); ?>

</p>

<a href="product_details.php?id=<?php echo $row['product_id']; ?>">

View Details

</a>

</div>

<?php

}

?>

</div>

</section>



<section class="why">

<h2>

Why Choose HochipoHub?

</h2>

<div class="why-grid">

<div>

<i class="fa-solid fa-shield-halved"></i>

<h3>

Secure Login

</h3>

<p>

Multi Factor Authentication

</p>

</div>

<div>

<i class="fa-solid fa-credit-card"></i>

<h3>

Secure Payment

</h3>

<p>

FPX / Debit / Credit

</p>

</div>

<div>

<i class="fa-solid fa-truck"></i>

<h3>

Fast Delivery

</h3>

<p>

Pickup & Postage

</p>

</div>

<div>

<i class="fa-solid fa-store"></i>

<h3>

Trusted Vendors

</h3>

<p>

Verified by Admin

</p>

</div>

</div>

</section>



<section class="review-home">

<h2>

Latest Reviews

</h2>

<div class="review-grid">

<?php

$sql="SELECT reviews.*,users.name

FROM reviews

INNER JOIN users

ON reviews.customer_id=users.user_id

LIMIT 3";

$result=mysqli_query($conn,$sql);

while($review=mysqli_fetch_assoc($result))

{

?>

<div class="review-card">

<h3>

<?php echo $review['name']; ?>

</h3>

<p>

⭐ <?php echo $review['rating']; ?>/5

</p>

<p>

<?php echo $review['review']; ?>

</p>

</div>

<?php

}

?>

</div>

</section>

<?php

include 'includes/footer.php';

?>