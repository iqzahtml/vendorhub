<?php
/* =====================================================
   HOCHIPOHUB
   Login Modal
===================================================== */
?>


<div id="loginModal" class="auth-modal">


<div class="modal-overlay"></div>



<div class="modal-box login-modal-box">



<!-- CLOSE BUTTON -->

<button 
class="modal-close"
onclick="closeLogin()">

<i class="fa-solid fa-xmark"></i>

</button>






<!-- HEADER -->

<div class="modal-header">


<img 
src="<?= BASE_URL ?>image/logo.jpg"
class="modal-logo">


<h2>

Welcome Back

</h2>


<p>

Login to continue shopping at HochipoHub

</p>


</div>







<!-- ALERT MESSAGE -->

<?php

if(isset($_SESSION['login_error'])):

?>

<div class="auth-alert error">

<i class="fa-solid fa-circle-exclamation"></i>


<span>

<?= $_SESSION['login_error']; ?>

</span>


</div>


<?php

unset($_SESSION['login_error']);

endif;

?>








<!-- LOGIN FORM -->

<form 
id="loginForm"
action="<?= BASE_URL ?>auth/login_process.php"
method="POST">







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
placeholder="Enter your email"
required>



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
placeholder="Enter your password"
required>



</div>



</div>








<!-- OPTION -->

<div class="auth-options">



<label class="remember-me">


<input 
type="checkbox"
name="remember">


Remember me


</label>





<a 
class="forgot-password"
href="<?= BASE_URL ?>forgot_password.php">

Forgot Password?

</a>



</div>








<!-- BUTTON -->

<button 
type="submit"
class="auth-submit">


<i class="fa-solid fa-right-to-bracket"></i>


Login


</button>








</form>








<!-- REGISTER SWITCH -->

<div class="auth-switch">


Don't have an account?


<a onclick="switchToRegister()">

Create Account

</a>



</div>





</div>


</div>