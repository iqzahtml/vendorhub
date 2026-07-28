<?php
/* =====================================================
   HOCHIPOHUB
   Register Modal
===================================================== */
?>


<div id="registerModal" class="auth-modal">



<div class="modal-overlay"></div>





<div class="modal-box register-modal-box">





<!-- CLOSE -->

<button 
class="modal-close"
onclick="closeRegister()">


<i class="fa-solid fa-xmark"></i>


</button>







<!-- HEADER -->

<div class="modal-header">


<img 
src="<?= BASE_URL ?>image/logo.jpg"
class="modal-logo">



<h2>

Create Account

</h2>



<p>

Join HochipoHub today

</p>



</div>








<form

id="registerForm"

action="<?= BASE_URL ?>auth/register_process.php"

method="POST"

>









<!-- NAME -->

<div class="auth-form-group">


<label>

Full Name

</label>



<div class="input-icon">


<i class="fa-solid fa-user"></i>


<input

type="text"

name="name"

placeholder="Enter your name"

required>


</div>


</div>









<!-- EMAIL -->

<div class="auth-form-group">


<label>

Email Address

</label>



<div class="input-icon">


<i class="fa-solid fa-envelope"></i>


<input

type="email"

name="email"

placeholder="example@email.com"

required>


</div>


</div>









<!-- PHONE -->

<div class="auth-form-group">


<label>

Phone Number

</label>



<div class="input-icon">


<i class="fa-solid fa-phone"></i>


<input

type="text"

name="phone"

placeholder="01XXXXXXXX"


required>


</div>


</div>









<!-- ROLE -->

<div class="auth-form-group">


<label>

Register As

</label>




<div class="role-selector">





<div class="role-option">


<input

type="radio"

id="customerRole"

name="role"

value="customer"

checked>



<label for="customerRole">


<i class="fa-solid fa-user"></i>


<span>

Customer

</span>


<small>

Buy products

</small>


</label>


</div>







<div class="role-option">


<input

type="radio"

id="vendorRole"

name="role"

value="vendor">


<label for="vendorRole">


<i class="fa-solid fa-store"></i>


<span>

Vendor

</span>


<small>

Sell products

</small>


</label>


</div>




</div>



</div>









<!-- PASSWORD -->

<div class="auth-form-group">


<label>

Password

</label>




<div class="auth-password input-icon">


<i class="fa-solid fa-lock"></i>



<input

type="password"

name="password"

placeholder="Minimum 8 characters"

required>



</div>






<div class="password-strength">


<div class="password-strength-bar">


<div class="password-strength-progress"></div>


</div>



<span class="password-strength-text">

Password strength

</span>


</div>



</div>









<!-- CONFIRM PASSWORD -->


<div class="auth-form-group">


<label>

Confirm Password

</label>



<div class="auth-password input-icon">


<i class="fa-solid fa-lock"></i>



<input

type="password"

name="confirm_password"

placeholder="Repeat password"

required>



</div>



</div>









<!-- TERMS -->


<div class="terms-check">


<input

type="checkbox"

required>



<span>

I agree with HochipoHub Terms & Conditions

</span>



</div>








<!-- SUBMIT -->


<button

type="submit"

class="auth-submit">


<i class="fa-solid fa-user-plus"></i>


Register


</button>






</form>








<div class="auth-switch">


Already have an account?


<a onclick="switchToLogin()">

Login here

</a>



</div>






</div>


</div>