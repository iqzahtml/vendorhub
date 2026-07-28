<?php

require_once "includes/header.php";

?>

<?php include "includes/navbar.php"; ?>

<?php include "includes/login_modal.php"; ?>

<section class="hero">

    ...

</section>

<section class="section">

    ...

</section>
<script>

window.onload=function(){

    document.getElementById("loginModal").style.display="flex";

}

function closeLoginModal(){

    document.getElementById("loginModal").style.display="none";

}

window.onclick=function(e){

    var modal=document.getElementById("loginModal");

    if(e.target==modal){

        modal.style.display="none";

    }

}

</script>

<?php include "includes/footer.php"; ?>