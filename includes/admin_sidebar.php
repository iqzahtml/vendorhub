<?php
/* =====================================================
   HOCHIPOHUB
   Admin Sidebar

   Admin Management Menu
===================================================== */


?>


<aside class="sidebar admin-sidebar">



<div class="sidebar-header">


<i class="fa-solid fa-user-shield"></i>


<h3>

Admin Panel

</h3>


</div>







<ul class="sidebar-menu">





<!-- DASHBOARD -->

<li>


<a href="<?= BASE_URL ?>admin/dashboard.php">


<i class="fa-solid fa-chart-line"></i>


Dashboard


</a>


</li>









<!-- USER MANAGEMENT -->


<li>


<a href="<?= BASE_URL ?>admin/users.php">


<i class="fa-solid fa-users"></i>


Manage Users


</a>


</li>









<!-- VENDOR MANAGEMENT -->


<li>


<a href="<?= BASE_URL ?>admin/vendors.php">


<i class="fa-solid fa-store"></i>


Manage Vendors


</a>


</li>









<!-- PRODUCT MANAGEMENT -->


<li>


<a href="<?= BASE_URL ?>admin/products.php">


<i class="fa-solid fa-box-open"></i>


Manage Products


</a>


</li>









<!-- ORDER MANAGEMENT -->


<li>


<a href="<?= BASE_URL ?>admin/orders.php">


<i class="fa-solid fa-receipt"></i>


Manage Orders


</a>


</li>









<!-- PAYMENT -->


<li>


<a href="<?= BASE_URL ?>admin/payments.php">


<i class="fa-solid fa-credit-card"></i>


Payment Monitoring


</a>


</li>









<!-- COMMISSION -->


<li>


<a href="<?= BASE_URL ?>admin/commission.php">


<i class="fa-solid fa-money-bill-transfer"></i>


Commission Report


</a>


</li>









<!-- REVIEW -->


<li>


<a href="<?= BASE_URL ?>admin/reviews.php">


<i class="fa-solid fa-star"></i>


Review Monitoring


</a>


</li>









<!-- INVENTORY -->


<li>


<a href="<?= BASE_URL ?>admin/inventory.php">


<i class="fa-solid fa-warehouse"></i>


Inventory


</a>


</li>









<!-- SETTINGS -->


<li>


<a href="<?= BASE_URL ?>admin/settings.php">


<i class="fa-solid fa-gear"></i>


System Settings


</a>


</li>









<!-- LOGOUT -->


<li>


<a href="<?= BASE_URL ?>auth/logout.php">


<i class="fa-solid fa-right-from-bracket"></i>


Logout


</a>


</li>






</ul>





</aside>