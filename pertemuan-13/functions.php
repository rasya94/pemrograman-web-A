<?php
require 'config.php';

function slugify($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function require_login()
{
    if (empty($_SESSION['user_id'])) {
        header("Location: /admin/login.php");
        exit;
    }
}