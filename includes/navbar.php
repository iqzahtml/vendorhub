<nav class="navbar">

<div class="container">

<div class="logo">

<a href="<?php echo BASE_URL; ?>index.php">

<img src="<?php echo BASE_URL; ?>images/logo.jpg" alt="HochipoHub">

<span>HochipoHub</span>

</a>

</div>

<ul class="menu">

<li>

<a href="<?php echo BASE_URL; ?>index.php">

Home

</a>

</li>

<li>

<a href="<?php echo BASE_URL; ?>catalog.php">

Catalog

</a>

</li>

<li>

<a href="<?php echo BASE_URL; ?>category.php">

Categories

</a>

</li>

<li>

<a href="<?php echo BASE_URL; ?>vendor.php">

Vendors

</a>

</li>

<li>

<a href="<?php echo BASE_URL; ?>dashboard.php">

Dashboard

</a>

</li>

</ul>

<div class="search-box">

<input
type="text"
id="searchInput"
placeholder="Search product...">

<button>

<i class="fa-solid fa-magnifying-glass"></i>

</button>

</div>

<div class="nav-right">

<a href="<?php echo BASE_URL; ?>cart.php">

<i class="fa-solid fa-cart-shopping"></i>

</a>

<?php

if(isset($_SESSION['user_id']))
{

?>

<div class="dropdown">

<button class="dropbtn">

<i class="fa-solid fa-user"></i>

<?php echo $_SESSION['name']; ?>

</button>

<div class="dropdown-content">

<a href="<?php echo BASE_URL; ?>profile.php">

Profile

</a>

<a href="<?php echo BASE_URL; ?>dashboard.php">

Dashboard

</a>

<a href="<?php echo BASE_URL; ?>auth/logout.php">

Logout

</a>

</div>

</div>

<?php

}

else

{

?>

<button class="login-btn" onclick="openLogin()">

Login

</button>

<button class="register-btn" onclick="openRegister()">

Register

</button>

<?php

}

?>

</div>

</div>

</nav>

<?php

include "login_modal.php";

include "register_modal.php";

?>