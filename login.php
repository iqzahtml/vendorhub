<?php

session_start();

include "config.php";


if(isset($_POST['email']) && isset($_POST['password']))
{

    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users 
            WHERE email='$email' 
            AND password='$password'";


    $result = mysqli_query($conn,$sql);


    if(mysqli_num_rows($result)>0)
    {

        $row = mysqli_fetch_assoc($result);


        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];



        // Redirect according to role

        if($row['role']=="customer")
        {
            header("Location: customer/dashboard.php");
        }


        else if($row['role']=="vendor")
        {
            header("Location: vendor/dashboard.php");
        }


        else if($row['role']=="admin")
        {
            header("Location: admin/dashboard.php");
        }


    }

    else
    {

        echo "
        <script>
        alert('Invalid email or password');
        window.location='index.php';
        </script>
        ";

    }

}


?>