<?php
/* =====================================================
   HOCHIPOHUB
   includes/header.php

   Global Header
===================================================== */


// Load Config

require_once DIR . "/../config.php";


// Load Database

require_once DIR . "/../database/db.php";


// Load Functions

require_once DIR . "/functions.php";


// Load Session

require_once DIR . "/session.php";


?>


<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>

<?php

echo isset($pageTitle)

?
$pageTitle." | ".SITE_NAME

:

SITE_NAME;

?>

</title>



<!-- Logo Icon -->

<link rel="icon" href="<?= BASE_URL ?>image/logo.jpg">



<!-- Google Font -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">



<!-- Font Awesome -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



<!-- Main CSS -->

<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">


<link rel="stylesheet" href="<?= BASE_URL ?>css/modal.css">


<link rel="stylesheet" href="<?= BASE_URL ?>css/login.css">


<link rel="stylesheet" href="<?= BASE_URL ?>css/responsive.css">


<?php if(isset($extraCSS)): ?>

<link rel="stylesheet" href="<?= BASE_URL ?>css/<?= $extraCSS ?>">

<?php endif; ?>


</head>


<body>


<?php


// Navbar

include DIR . "/navbar.php";


?>