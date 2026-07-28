<?php
/* =====================================================
   HOCHIPOHUB
   session.php

   User Session Management
===================================================== */


if(session_status() === PHP_SESSION_NONE){

    session_start();

}



/*
|--------------------------------------------------------------------------
| Check User Login
|--------------------------------------------------------------------------
*/

function checkLogin(){

    if(!isset($_SESSION['user_id'])){

        header(
            "Location: ".BASE_URL
        );

        exit();

    }

}



/*
|--------------------------------------------------------------------------
| Get Current User
|--------------------------------------------------------------------------
*/

function currentUser(){

    if(isset($_SESSION['user_id'])){

        return [

            "id" =>
            $_SESSION['user_id'],

            "name" =>
            $_SESSION['name'],

            "email" =>
            $_SESSION['email'],

            "role" =>
            $_SESSION['role']

        ];

    }


    return null;

}



/*
|--------------------------------------------------------------------------
| Check Role
|--------------------------------------------------------------------------
*/

function checkRole($role){


    if(
        !isset($_SESSION['role'])
        ||
        $_SESSION['role'] != $role
    ){

        header(
            "Location: ".BASE_URL
        );

        exit();

    }


}




/*
|--------------------------------------------------------------------------
| Logout Session
|--------------------------------------------------------------------------
*/

function destroySession(){


    session_unset();


    session_destroy();



    header(

        "Location: ".BASE_URL

    );


    exit();


}



?>