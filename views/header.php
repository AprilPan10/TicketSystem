<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticket System</title>
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
            <li><a href="profile.php">Profile</a></li>
            <li><a href="submitTicket.php">Create ticket</a></li>
            <li><a href="listTicket.php">Your tickets</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>

