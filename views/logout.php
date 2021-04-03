<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['userId']);
unset($_SESSION['userType']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log out</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<header id="header">
    <div id="logo">
        <h2 id="site-name">
            <a href="userHome.php">
                <img src="../images/img_1.png" alt="logo of twitch company" width="180"/>
            </a>
        </h2>
    </div>
    <nav id="main-navigation">
        <h3 class="hidden">Main navigation</h3>
        <button class="menu-toggle" onclick="toggleMenu()">MENU</button>
        <ul class="menu">
            <li><a href="userHome.php">Login</a></li>
        </ul>
    </nav>
</header>
<div class="container-table">
    <h1>You have been successfully logged out!</h1>
</div>
<?php
require_once '../views/footer.php';
?>
