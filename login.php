<?php

require_once "database/db.php";
require_once "includes/session.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "
        SELECT
            user_id,
            name,
            email,
            password,
            role,
            status
        FROM users
        WHERE email = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare(
        $conn,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if ($user['status'] !== 'active') {

            $message =
                "Your account is not active.";

        } elseif (
            password_verify(
                $password,
                $user['password']
            )
        ) {

            $_SESSION['user_id'] =
                $user['user_id'];

            $_SESSION['name'] =
                $user['name'];

            $_SESSION['email'] =
                $user['email'];

            $_SESSION['role'] =
                $user['role'];

            if ($user['role'] === 'admin') {

                header(
                    "Location: dashboard.php"
                );

            } elseif ($user['role'] === 'vendor') {

                header(
                    "Location: dashboard.php"
                );

            } else {

                header(
                    "Location: index.php"
                );

            }

            exit();

        } else {

            $message =
                "Invalid email or password.";

        }

    } else {

        $message =
            "Invalid email or password.";

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - VendorHub</title>

    <link rel="stylesheet"
          href="css/style.css">

    <link rel="stylesheet"
          href="css/login.css">

    <link rel="stylesheet"
            href="css/modal.css">

</head>

<body>
    <div id="loginModel" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>

<div class="auth-page">

    <div class="auth-container">

        <div class="auth-logo">

            Vendor<span>Hub</span>

        </div>

        <h2 class="auth-title">

            Welcome Back

        </h2>

        <?php if (!empty($message)): ?>

            <div class="error-message">

                <?= htmlspecialchars($message) ?>

            </div>

        <?php endif; ?>

        <form method="POST"
              action="login.php">

            <div class="form-group">

                <label for="email">

                    Email

                </label>

                <input type="email"
                       id="email"
                       name="email"
                       class="form-control"
                       required>

            </div>

            <div class="form-group">

                <label for="password">

                    Password

                </label>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-primary full-width">

                Login

            </button>

        </form>

        <div class="auth-footer">

            Don't have an account?

            <a href="register.php">

                Register here

            </a>
        

        </div>

    </div>

</div>

<script src ="script.js"></script>

</body>

</html>