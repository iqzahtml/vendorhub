<?php
/* =====================================================
   HOCHIPOHUB
   auth/register_process.php

   User Registration Process
===================================================== */


require_once "../config.php";

require_once "../database/db.php";

require_once "../includes/functions.php";





if($_SERVER['REQUEST_METHOD'] !== "POST"){


    header(
        "Location: ".BASE_URL
    );

    exit();


}






// GET FORM DATA


$name = clean($_POST['name']);

$email = clean($_POST['email']);

$phone = clean($_POST['phone']);

$role = clean($_POST['role']);

$password = $_POST['password'];

$confirm_password = $_POST['confirm_password'];






// CHECK PASSWORD MATCH


if($password !== $confirm_password){



    $_SESSION['register_error'] =
    "Password does not match";



    header(
        "Location: ".BASE_URL
    );


    exit();


}







// CHECK EMAIL EXIST


$checkEmail = $conn->prepare(

"
SELECT user_id 
FROM users 
WHERE email = ?

"

);



$checkEmail->execute([

    $email

]);





if($checkEmail->rowCount() > 0){



    $_SESSION['register_error'] =
    "Email already registered";



    header(
        "Location: ".BASE_URL
    );


    exit();



}









// HASH PASSWORD


$hashedPassword = hashPassword(
    $password
);








// INSERT USER


$sql = "

INSERT INTO users

(
name,
email,
phone,
password,
role,
status

)

VALUES

(
?,
?,
?,
?,
?,
'active'

)

";






$stmt = $conn->prepare($sql);





$stmt->execute([


$name,

$email,

$phone,

$hashedPassword,

$role


]);







$user_id =
$conn->lastInsertId();








/*
|--------------------------------------------------------------------------
| IF REGISTER AS VENDOR
|--------------------------------------------------------------------------
*/


if($role == "vendor"){



    
    $vendor = $conn->prepare(

    "

    INSERT INTO vendors

    (

    user_id,
    business_name,
    approval_status

    )

    VALUES

    (

    ?,
    ?,
    'Pending'

    )

    "

    );





    $vendor->execute([


        $user_id,

        $name."'s Store"


    ]);





    $_SESSION['success'] =

    "Account created. Complete your vendor profile.";



    header(

        "Location: "
        .BASE_URL
        ."profile.php"

    );


    exit();



}








/*
|--------------------------------------------------------------------------
| CUSTOMER REDIRECT
|--------------------------------------------------------------------------
*/


$_SESSION['success'] =

"Registration successful. Please login.";





header(

    "Location: "
    .BASE_URL

);



exit();



?>