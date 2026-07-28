<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

require_once DIR . "/database/db.php";
require_once DIR . "/includes/functions.php";
require_once DIR . "/includes/security.php";
require_once DIR . "/includes/session.php";

define("SITE_NAME", "HochipoHub");
define("BASE_URL", "http://localhost/hochipohub/");

?>