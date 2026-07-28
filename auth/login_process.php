<?php
/* =====================================================
   HOCHIPOHUB
   auth/login_process.php

   Login Controller
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







$email =
clean($_POST['email']);



$password =
$_POST['password'];









// FIND USER


$stmt = $conn->prepare(

"

SELECT *

FROM users

WHERE email = ?

AND status='active'

"

);



$stmt->execute([

$email

]);





$user = $stmt->fetch();








if(!$user){



$_SESSION['login_error'] =

"Email not found";



header(

"Location: ".BASE_URL

);



exit();



}









// VERIFY PASSWORD


if(
!password_verify(
$password,
$user['password']
)

){



$_SESSION['login_error'] =

"Incorrect password";



header(

"Location: ".BASE_URL

);



exit();



}









/*
|--------------------------------------------------------------------------
| CREATE SESSION
|--------------------------------------------------------------------------
*/



$_SESSION['user_id'] =

$user['user_id'];



$_SESSION['name'] =

$user['name'];



$_SESSION['email'] =

$user['email'];



$_SESSION['role'] =

$user['role'];










/*
|--------------------------------------------------------------------------
| ROLE REDIRECT
|--------------------------------------------------------------------------
*/


if($user['role']=="admin"){



header(

"Location: "
.BASE_URL
."admin/dashboard.php"

);



exit();



}







if($user['role']=="vendor"){



header(

"Location: "
.BASE_URL
."dashboard.php"

);



exit();



}








// CUSTOMER


header(

"Location: "
.BASE_URL
."dashboard.php"

);



exit();




?>