<?php

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hash)
{
    return password_verify($password, $hash);
}

function generateToken()
{
    return bin2hex(random_bytes(32));
}

function csrfToken()
{
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = generateToken();
    }

    return $_SESSION['csrf'];
}

function verifyCSRF($token)
{
    return isset($_SESSION['csrf']) &&
        hash_equals($_SESSION['csrf'], $token);
}

?>