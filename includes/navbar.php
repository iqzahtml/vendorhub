<?php
/* =====================================================
   HOCHIPOHUB
   includes/navbar.php

   Main Navigation Bar
===================================================== */


$user = currentUser();

?>


<nav class="navbar">


<div class="nav-container">



<!-- ===========================
     LOGO
=========================== -->


<a href="<?= BASE_URL ?>index.php" class="nav-logo">


<img 
src="<?= BASE_URL ?>image/logo.jpg"
alt="HochipoHub Logo">


<span>

HochipoHub

</span>


</a>








<!-- ===========================
     NAVIGATION MENU
=========================== -->


<ul class="nav-menu">



<li>

<a 
href="<?= BASE_URL ?>index.php"
class="<?= activePage('index.php') ?>">


<i class="fa-solid fa-house"></i>

Home


</a>

</li>






<li>

<a 
href="<?= BASE_URL ?>catalog.php"
class="<?= activePage('catalog.php') ?>">


<i class="fa-solid fa-store"></i>


Products


</a>


</li>







<li>

<a 
href="<?= BASE_URL ?>category.php"
class="<?= activePage('category.php') ?>">


<i class="fa-solid fa-layer-group"></i>


Categories


</a>


</li>







<li>

<a 
href="<?= BASE_URL ?>vendor.php"
class="<?= activePage('vendor.php') ?>">


<i class="fa-solid fa-shop"></i>


Vendors


</a>


</li>







<li>

<a 
href="<?= BASE_URL ?>contact.php"
class="<?= activePage('contact.php') ?>">


<i class="fa-solid fa-envelope"></i>


Contact


</a>


</li>





</ul>









<!-- ===========================
     RIGHT NAVIGATION
=========================== -->


<div class="nav-actions">






<?php if(!$user): ?>



<!-- LOGIN -->

<button

class="nav-login"

onclick="openLogin()">


<i class="fa-solid fa-right-to-bracket"></i>


Login


</button>






<!-- REGISTER -->


<button

class="nav-register"

onclick="openRegister()">


<i class="fa-solid fa-user-plus"></i>


Register


</button>







<?php else: ?>





<!-- CART -->


<a 

href="<?= BASE_URL ?>cart.php"

class="cart-btn">


<i class="fa-solid fa-cart-shopping"></i>


<span id="cartCount">

0

</span>


</a>









<!-- USER PROFILE -->


<div class="user-dropdown">



<button 
class="user-dropdown-btn">


<img

src="<?= BASE_URL ?>image/logo.jpg"

class="user-avatar">


<span>

<?= clean($user['name']); ?>

</span>


<i class="fa-solid fa-chevron-down"></i>


</button>








<div class="user-dropdown-menu">





<a href="<?= BASE_URL ?>profile.php">


<i class="fa-solid fa-user"></i>


My Profile


</a>







<?php if($user['role']=="customer"): ?>


<a href="<?= BASE_URL ?>order.php">


<i class="fa-solid fa-box"></i>


My Orders


</a>



<?php endif; ?>








<?php if($user['role']=="vendor"): ?>


<a href="<?= BASE_URL ?>dashboard.php">


<i class="fa-solid fa-chart-line"></i>


Vendor Dashboard


</a>



<a href="<?= BASE_URL ?>product.php">


<i class="fa-solid fa-box-open"></i>


Manage Products


</a>



<?php endif; ?>








<?php if($user['role']=="admin"): ?>


<a href="<?= BASE_URL ?>admin/index.php">


<i class="fa-solid fa-user-shield"></i>


Admin Panel


</a>



<?php endif; ?>







<a href="<?= BASE_URL ?>auth/logout.php">


<i class="fa-solid fa-right-from-bracket"></i>


Logout


</a>





</div>


</div>





<?php endif; ?>






<!-- MOBILE MENU -->


<button 

class="mobile-menu-btn"

onclick="toggleMobileMenu()">



<i class="fa-solid fa-bars"></i>



</button>





</div>





</div>


</nav>









<!-- ===========================
     LOGIN / REGISTER MODAL
=========================== -->


<?php

include DIR . "/login_modal.php";

include DIR . "/register_modal.php";


?>