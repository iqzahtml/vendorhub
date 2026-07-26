<?php require_once "includes/header.php"; ?>

<?php include "includes/navbar.php"; ?>

<!-- LOGIN MODAL -->
<div id="loginModal" class="modal">

    ...
    (kod modal login anda)
    ...

</div>

<!-- Hero -->
<section class="hero">

    ...

</section>

<section class="section">

    ...

</section>

<!-- LETAK SCRIPT DI SINI -->
<script>

window.onload = function () {

    document.getElementById("loginModal").style.display = "flex";

}

function closeLoginModal() {

    document.getElementById("loginModal").style.display = "none";

}

window.onclick = function (e) {

    if (e.target == document.getElementById("loginModal")) {

        document.getElementById("loginModal").style.display = "none";

    }

}

</script>

<?php include "includes/footer.php"; ?>