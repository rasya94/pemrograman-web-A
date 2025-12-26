<?php
session_start();

$conn = new mysqli("localhost", "root", "", "news_portal");
if ($conn->connect_error) {
    die("Database connection failed");
}
