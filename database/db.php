<?php
/* =====================================================
   HOCHIPOHUB
   database/db.php

   Database Connection
===================================================== */



$host = "localhost";

$username = "root";

$password = "";

$database = "hochipohub";



try{


    $conn = new PDO(

        "mysql:host=".$host.";dbname=".$database.";charset=utf8",

        $username,

        $password

    );



    // Error mode

    $conn->setAttribute(

        PDO::ATTR_ERRMODE,

        PDO::ERRMODE_EXCEPTION

    );



    // Fetch mode

    $conn->setAttribute(

        PDO::ATTR_DEFAULT_FETCH_MODE,

        PDO::FETCH_ASSOC

    );



}


catch(PDOException $e){


    die(

        "Database Connection Failed: "
        .$e->getMessage()

    );


}


?>