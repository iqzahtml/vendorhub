<?php
/* =====================================================
   HOCHIPOHUB
   includes/footer.php

   Global Footer
===================================================== */
?>


<footer class="footer">


<div class="footer-container">



<!-- BRAND -->

<div class="footer-section">


<div class="footer-logo">


<img src="<?= BASE_URL ?>image/logo.jpg">


<h3>
HochipoHub
</h3>


</div>



<p>

A trusted marketplace connecting customers
with amazing local vendors.

</p>



<div class="footer-social">


<a href="#">
<i class="fa-brands fa-facebook"></i>
</a>


<a href="#">
<i class="fa-brands fa-instagram"></i>
</a>


<a href="#">
<i class="fa-brands fa-tiktok"></i>
</a>


<a href="#">
<i class="fa-brands fa-twitter"></i>
</a>


</div>


</div>






<!-- QUICK LINKS -->

<div class="footer-section">


<h4>
Quick Links
</h4>


<ul>


<li>

<a href="<?= BASE_URL ?>index.php">

Home

</a>

</li>



<li>

<a href="<?= BASE_URL ?>catalog.php">

Products

</a>

</li>



<li>

<a href="<?= BASE_URL ?>category.php">

Categories

</a>

</li>



<li>

<a href="<?= BASE_URL ?>vendor.php">

Vendors

</a>

</li>


<li>

<a href="<?= BASE_URL ?>contact.php">

Contact

</a>

</li>



</ul>


</div>







<!-- CUSTOMER -->

<div class="footer-section">


<h4>
Customer
</h4>


<ul>


<li>

<a href="<?= BASE_URL ?>profile.php">

My Account

</a>

</li>



<li>

<a href="<?= BASE_URL ?>cart.php">

Shopping Cart

</a>

</li>



<li>

<a href="<?= BASE_URL ?>order.php">

My Orders

</a>

</li>



<li>

<a href="<?= BASE_URL ?>review.php">

Reviews

</a>

</li>


</ul>


</div>







<!-- CONTACT -->

<div class="footer-section">


<h4>
Contact Us
</h4>


<ul class="footer-contact">


<li>

<i class="fa-solid fa-envelope"></i>

support@hochipohub.com

</li>



<li>

<i class="fa-solid fa-phone"></i>

+60 12-345 6789

</li>



<li>

<i class="fa-solid fa-location-dot"></i>

Malaysia

</li>


</ul>


</div>



</div>






<div class="footer-bottom">


<p>

© <?= date("Y"); ?> HochipoHub.
All Rights Reserved.

</p>


</div>




</footer>





<!-- JAVASCRIPT -->


<script src="<?= BASE_URL ?>js/script.js"></script>

<script src="<?= BASE_URL ?>js/modal.js"></script>

<script src="<?= BASE_URL ?>js/validation.js"></script>



<?php if(isset($extraJS)): ?>


<script src="<?= BASE_URL ?>js/<?= $extraJS ?>"></script>


<?php endif; ?>



</body>

</html>