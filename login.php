<?php
require 'decrypt.php';
require 'dataColor.php';

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$users = get_users();
if (!array_key_exists($username, $users)) {
    $_SESSION['login'] = false;
    header('Location: /index.php');
}

if (!hash_equals($users[$username], $password)) {
    $_SESSION['login'] = false;
    $_SESSION['bazdmegIttARendorseg'] = true;
    header('Location: /index.php');
}

$color = string_to_color(get_user_color($username));

$_SESSION['login'] = true;
$_SESSION['fav_color'] = $color;
header('Location: /index.php');
?>
