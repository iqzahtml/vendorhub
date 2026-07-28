<?php

function clean($data)
{
    return htmlspecialchars(trim($data));
}

function randomCode($length = 6)
{
    return substr(str_shuffle("0123456789"), 0, $length);
}

function uploadImage($file, $folder)
{
    if ($file['error'] != 0) {
        return "";
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $filename = uniqid() . "." . $extension;

    move_uploaded_file(
        $file['tmp_name'],
        "uploads/$folder/" . $filename
    );

    return $filename;
}

function formatPrice($price)
{
    return "RM " . number_format($price, 2);
}

?>