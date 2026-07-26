<?php

require_once "includes/header.php";

?>

<?php include "includes/navbar.php"; ?>

<!-- Login Modal -->
<div id="loginModal" class="modal">

    ...

</div>

<section class="hero">

    ...

</section>

<section class="section">

    ...

</section>

<script>

window.onload = function () {

    document.getElementById("loginModal").style.display = "flex";

}

function closeLoginModal() {

    document.getElementById("loginModal").style.display = "none";

}

window.onclick = function (event) {

    if (event.target == document.getElementById("loginModal")) {

        document.getElementById("loginModal").style.display = "none";

    }

}

</script>

<?php include "includes/footer.php"; ?>