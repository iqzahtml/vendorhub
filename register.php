<?php

require_once "database/db.php";
require_once "includes/session.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name =
        trim($_POST['name']);

    $email =
        trim($_POST['email']);

    $phone =
        trim($_POST['phone']);

    $password =
        $_POST['password'];

    $role =
        $_POST['role'];

    $checkSql = "
        SELECT user_id
        FROM users
        WHERE email = ?
    ";

    $checkStmt =
        mysqli_prepare(
            $conn,
            $checkSql
        );

    mysqli_stmt_bind_param(
        $checkStmt,
        "s",
        $email
    );

    mysqli_stmt_execute(
        $checkStmt
    );

    mysqli_stmt_store_result(
        $checkStmt
    );

    if (
        mysqli_stmt_num_rows(
            $checkStmt
        ) > 0
    ) {

        $message =
            "Email already exists.";

    } else {

        $hashedPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );

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
            VALUES (?, ?, ?, ?, ?, 'active')
        ";

        $stmt =
            mysqli_prepare(
                $conn,
                $sql
            );

        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $name,
            $email,
            $phone,
            $hashedPassword,
            $role
        );

        if (
            mysqli_stmt_execute(
                $stmt
            )
        ) {

            header(
                "Location: login.php"
            );

            exit();

        } else {

            $message =
                "Registration failed.";

        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($checkStmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register - VendorHub</title>

    <link rel="stylesheet"
          href="css/style.css">

    <link rel="stylesheet"
          href="css/login.css">

</head>

<body>

<div class="auth-page">

    <div class="auth-container">

        <div class="auth-logo">

            Vendor<span>Hub</span>

        </div>

        <h2 class="auth-title">

            Create Account

        </h2>

        <?php if (!empty($message)): ?>

            <div class="error-message">

                <?= htmlspecialchars($message) ?>

            </div>

        <?php endif; ?>

        <form method="POST"
              action="register.php">

            <div class="form-group">

                <label for="name">

                    Full Name

                </label>

                <input type="text"
                       id="name"
                       name="name"
                       class="form-control"
                       required>

            </div>

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

                <label for="phone">

                    Phone

                </label>

                <input type="text"
                       id="phone"
                       name="phone"
                       class="form-control">

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

            <div class="form-group">
                <label for="role">

                    Register As

                </label>

                <select id="role"
                        name="role"
                        class="form-control"
                        required>

                    <option value="customer">

                        Customer

                    </option>

                    <option value="vendor">

                        Vendor

                    </option>

                </select>

            </div>

            <button type="submit"
                    class="btn btn-primary full-width">

                Create Account

            </button>

        </form>

        <div class="auth-footer">

            Already have an account?

            <a href="login.php">

                Login here

            </a>

        </div>

    </div>

</div>

</body>

</html>