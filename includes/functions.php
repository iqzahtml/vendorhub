<?php
/* =====================================================
   HOCHIPOHUB
   functions.php

   Global Helper Functions
===================================================== */



/*
|--------------------------------------------------------------------------
| Sanitize Input
|--------------------------------------------------------------------------
*/

function clean($data){


    return htmlspecialchars(

        trim($data),

        ENT_QUOTES,

        'UTF-8'

    );


}





/*
|--------------------------------------------------------------------------
| Redirect Page
|--------------------------------------------------------------------------
*/

function redirect($page){


    header(

        "Location: ".$page

    );


    exit();


}




/*
|--------------------------------------------------------------------------
| Display Alert
|--------------------------------------------------------------------------
*/

function alert(
    $message,
    $type="info"
){


echo '

<div class="auth-alert '.$type.'">

<i class="fa-solid fa-circle-info"></i>

<span>
'.$message.'
</span>

</div>

';


}





/*
|--------------------------------------------------------------------------
| Check Active Page
|--------------------------------------------------------------------------
*/

function activePage($page){


$current =
basename($_SERVER['PHP_SELF']);



if($current == $page){

    return "active";

}


return "";

}




/*
|--------------------------------------------------------------------------
| Format Price
|--------------------------------------------------------------------------
*/

function formatPrice($price){


return "RM "
.number_format(
    $price,
    2
);


}




/*
|--------------------------------------------------------------------------
| Generate Random OTP
|--------------------------------------------------------------------------
*/

function generateOTP(){


return rand(
    100000,
    999999
);


}




/*
|--------------------------------------------------------------------------
| Password Hash
|--------------------------------------------------------------------------
*/

function hashPassword($password){


return password_hash(

    $password,

    PASSWORD_DEFAULT

);


}




/*
|--------------------------------------------------------------------------
| Verify Password
|--------------------------------------------------------------------------
*/

function verifyPassword(
    $password,
    $hash
){


return password_verify(

    $password,

    $hash

);


}




/*
|--------------------------------------------------------------------------
| Upload Image
|--------------------------------------------------------------------------
*/

function uploadImage(
    $file,
    $folder
){



$allowed = [

    "jpg",
    "jpeg",
    "png",
    "webp"

];



$filename =
$file['name'];



$extension =
strtolower(
    pathinfo(
        $filename,
        PATHINFO_EXTENSION
    )
);



if(
    !in_array(
        $extension,
        $allowed
    )
){

    return false;

}




$newName =
uniqid()
."."
.$extension;



$destination =
$folder
.$newName;



if(
    move_uploaded_file(
        $file['tmp_name'],
        $destination
    )
){

    return $newName;

}



return false;



}



?>