<?php
/* =====================================================
   HOCHIPOHUB
   config.php

   Main Website Configuration
===================================================== */


// Website Name

define(
    "SITE_NAME",
    "HochipoHub"
);



// Website URL

define(
    "BASE_URL",
    "http://localhost/hochipohub/"
);



// Upload Path

define(
    "UPLOAD_PATH",
    DIR . "/uploads/"
);



// Product Image Path

define(
    "PRODUCT_IMAGE",
    BASE_URL . "uploads/products/"
);



// Vendor Image Path

define(
    "VENDOR_IMAGE",
    BASE_URL . "uploads/vendors/"
);



// Session Start

if(session_status() === PHP_SESSION_NONE){

    session_start();

}


?>