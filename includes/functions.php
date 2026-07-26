<?php

function redirect($page) {
    header("Location: $page");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect("login.php");
    }
}

function cleanInput($conn, $data) {
    return mysqli_real_escape_string(
        $conn,
        trim($data)
    );
}

function formatPrice($price) {
    return "RM " . number_format($price, 2);
}

?>