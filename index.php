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

window.onload = function () {

    const modal = document.getElementById("loginModal");

    modal.style.display = "flex";

}

function closeLoginModal(){

    document.getElementById("loginModal").style.display="none";

}

window.onclick=function(event){

    const modal=document.getElementById("loginModal");

    if(event.target==modal){

        modal.style.display="none";

    }

}

</script>

<?php include "includes/footer.php"; ?>