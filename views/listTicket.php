<?php
require_once '../views/header.php';
session_start();
$xml = simplexml_load_file("../xml/users.xml");
$id = $_SESSION['userId'];
?>
<?php
//display admin tickets
$rows='';
//$xml = simplexml_load_file("../xml/users.xml");
$userType = $_SESSION['userType'];
if($userType == "admin"){
    $xml = simplexml_load_file("../xml/tickets.xml");
    foreach ($xml as $t){
        $rows .= '<tr>';
        $rows .= '<td>'.$t->attributes()['ticketId'].'</td>';
        $rows .= '<td>'.$t->dateOpen.'</td>';
        $rows .= '<td>'.$t->status.'</td>';
        $rows .= '<td>'.$t->attributes()['userId'].'</td>';
        $rows .= '<td>' .'<a href=detailTicket.php?'.$t->attributes()['ticketId'].'>'.'Details'.'</a>';
        $rows .= '</tr>';
    }
}else{//display users tickets
    $rows = '';
    $xml = simplexml_load_file("../xml/tickets.xml");
    $res = $xml->xpath("//ticket[@userId =$id]");
    foreach ($res as $t) {
        $rows .= '<tr>';
        $rows .= '<td>' . $t->attributes()['ticketId'] . '</td>';
        $rows .= '<td>' . $t->dateOpen . '</td>';
        $rows .= '<td>' . $t->status . '</td>';
        $rows .= '<td>' . $t->attributes()['userId'] . '</td>';
        $rows .= '<td>' .'<a href=detailTicket.php?'.$t->attributes()['ticketId'].'>'.'Details'.'</a>';
        $rows .= '</tr>';

    }

}
if($id=null||$_SESSION['userType']==null){
    header('location:../views/userHome.php');
}
?>
<div class="container-table">
     <?php echo '<p class="welcome">Welcome Back ' . $_SESSION['username']. ' !</p>'; ?>
    <h1>Your tickets</h1>
    <table>
        <thead>
        <tr>
            <th>Ticket ID</th>
            <th>Date Opened</th>
            <th>Status</th>
            <th>Client ID</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
            <?php print $rows; ?>
        </tbody>
    </table>
</div>
<?php
require_once '../views/footer.php';
?>



