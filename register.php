<?php

include "config.php";


if(isset($_POST['register']))
{

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];



    $sql = "INSERT INTO users
            (name,email,phone,password,role,status)

            VALUES

            ('$name',
             '$email',
             '$phone',
             '$password',
             '$role',
             'active')";



    if(mysqli_query($conn,$sql))
    {

        echo "
        <script>
        alert('Registration successful');
        window.location='index.php';
        </script>
        ";

    }

    else
    {

        echo "Error: ".mysqli_error($conn);

    }

}


?>


<!DOCTYPE html>
<html>

<head>

<title>Register VendorHub</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<div class="popup-content">


<h2>Create Account</h2>


<form method="POST">


<label>Name</label>

<input type="text" name="name" required>



<label>Email</label>

<input type="email" name="email" required>



<label>Phone</label>

<input type="text" name="phone" required>



<label>Password</label>

<input type="password" name="password" required>



<label>Register As</label>


<select name="role">


<option value="customer">
Customer
</option>


<option value="vendor">
Vendor
</option>


</select>


<br><br>


<button type="submit" name="register">
Register
</button>


</form>


</div>


</body>

</html>