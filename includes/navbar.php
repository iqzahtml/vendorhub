<?php
/* =====================================================
   HOCHIPOHUB
   includes/navbar.php
===================================================== */


$user = currentUser();


?>


<nav class="navbar">


<div class="nav-container">



<!-- LOGO -->

<a href="<?= BASE_URL ?>" class="nav-logo">


<img src="<?= BASE_URL ?>image/logo.jpg">


<span>

HochipoHub

</span>


</a>





<!-- MENU -->

<ul class="nav-menu">


<li>

<a href="<?= BASE_URL ?>index.php">

<i class="fa-solid fa-house"></i>

Home

</a>

</li>



<li>

<a href="<?= BASE_URL ?>catalog.php">

<i class="fa-solid fa-store"></i>

Products

</a>

</li>



<li>

<a href="<?= BASE_URL ?>category.php">

<i class="fa-solid fa-layer-group"></i>

Category

</a>

</li>



<li>

<a href="<?= BASE_URL ?>vendor.php">

<i class="fa-solid fa-shop"></i>

Vendor

</a>

</li>



<li>

<a href="<?= BASE_URL ?>contact.php">

<i class="fa-solid fa-envelope"></i>

Contact

</a>

</li>



</ul>





<!-- RIGHT SIDE -->

<div class="nav-actions">



<?php if(!$user): ?>


<button 
class="nav-login"
onclick="openLogin()">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>




<button 
class="nav-register"
onclick="openRegister()">

Register

</button>



<?php else: ?>



<div class="nav-user">


<i class="fa-solid fa-user-circle"></i>


<span>

<?= clean($user['name']); ?>

</span>



</div>





<a href="<?= BASE_URL ?>cart.php" 
class="cart-btn">


<i class="fa-solid fa-cart-shopping"></i>


<span id="cartCount">

0

</span>


</a>





<div class="dropdown">


<button class="drop-btn">

<i class="fa-solid fa-bars"></i>

</button>



<div class="dropdown-menu">


<a href="<?= BASE_URL ?>profile.php">

Profile

</a>



<?php if($user['role']=="vendor"): ?>


<a href="<?= BASE_URL ?>dashboard.php">

Dashboard

</a>


<?php endif; ?>




<?php if($user['role']=="admin"): ?>


<a href="<?= BASE_URL ?>admin/index.php">

Admin Panel

</a>


<?php endif; ?>



<a href="<?= BASE_URL ?>auth/logout.php">

Logout

</a>


</div>


</div>



<?php endif; ?>



</div>




<!-- MOBILE BUTTON -->

<button class="mobile-menu-btn">


<i class="fa-solid fa-bars"></i>


</button>



</div>


</nav>