<?php
require_once '../views/header.php';
session_start();
$xml = simplexml_load_file("../xml/users.xml");
$id = $_SESSION['userId'];
?>
<?php
//display admin tickets
$rows='';
$xml = simplexml_load_file("../xml/users.xml");
$userType = $_SESSION['userType'];
if($userType == "admin"){
    $xml = simplexml_load_file("../xml/users.xml");
    foreach ($xml as $t){
        $rows .= '<div class="users">';
        $rows .= '<p>User Id: '.$t->attributes()['userId'].'</p>';
        $rows .= '<p>User Name: '.$t->userName.'</p>';
        $rows .= '<p>First Name: '.$t->name->first.'</p>';
        $rows .= '<p>Last Name: '.$t->name->last.'</p>';
        $rows .= '<p>Email: '.$t->email.'</p>';
        $rows .= '<p>Phone number: '.$t->contactNumber->phone.'</p>';
        $rows .= '<p>Address: '.$t->address->street.' '. $t->address->city. ' '. $t->address->province. ' '. $t->address->postcode.'</p>';
        $rows .= '<p>Description: '.$t->description.'</p><br>';
        $rows .= '</div>';
    }
}else{//display users tickets
    $rows = '';
    $ticketId='';
    $ticketsId='';
    $xml = simplexml_load_file("../xml/users.xml");
    $res = $xml->xpath("//user[@userId =$id]");
    foreach ($res as $t) {
        $rows .= '<div class="users">';
        $rows .= '<p>User Id: '.$t->attributes()['userId'].'</p>';
        $rows .= '<p>User Name: '.$t->userName.'</p>';
        $rows .= '<p>First Name: '.$t->name->first.'</p>';
        $rows .= '<p>Last Name: '.$t->name->last.'</p>';
        $rows .= '<p>Email: '.$t->email.'</p>';
        $rows .= '<p>Phone number: '.$t->contactNumber->phone.'</p>';
        $rows .= '<p>Address: '.$t->address->street.' '. $t->address->city. ' '. $t->address->province. ' '. $t->address->postcode.'</p>';
        $rows .= '<p>Description: '.$t->description.'</p><br>';
        $rows .= '</div>';
    }

}
if($id=null||$_SESSION['userType']==null){
    header('location:../views/userHome.php');
}
?>
    <div class="container-table">
        <?php echo '<p class="welcome">Welcome Back ' . $_SESSION['username']. ' !</p>'; ?>
        <h1>Users' Profile</h1>
            <?php print $rows; ?>

    </div>
    <script src="../js/script.js"></script>
<?php
require_once '../views/footer.php';
?>

