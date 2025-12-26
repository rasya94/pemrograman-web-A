<?php
$conn = new mysqli("localhost","root","","news_portal");
$conn->query("
INSERT INTO users (username,password,fullname)
VALUES (
 'admin',
 '".password_hash("admin123", PASSWORD_BCRYPT)."',
 'Administrator'
)");
