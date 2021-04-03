<?php
$error = false;
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password= md5($_POST['password']);
    if(file_exists('../xml/users.xml')){
        $xml = simplexml_load_file("../xml/users.xml");
            foreach ($xml->children() as $p){
            $myPass = $p->password;
            $id = $p->attributes()['userId'];
            $user = $p->userName;
            $userType = $p->attributes()['userType'];
            if($password == $myPass && $username == $user){
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['userId'] = "$id";
                $_SESSION['userType'] = "$userType";
                header('Location:../views/listTicket.php');
                die;
            }
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
<div class="container">
<h1>Welcome</h1>
    <form action="" method="post">
        <div>
            <input type="text" placeholder="Email" name="username" class="input">
        </div>
        <div>
            <input type="password" placeholder="Password" name="password" class="input" >
        </div>
        <?php
        if($error){
           echo '<p class="welcome">Invalid username or password</p>';
        }
        ?>
        <div>
            <button type="submit" value="submit" name="submit" class="button">LOGIN</button>
        </div>
    </form>
</div>
<?php
require_once '../views/footer.php';
?>

