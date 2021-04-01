<?php
session_start();
$xml = simplexml_load_file("../xml/tickets.xml");
$userId=$_SESSION['userId'];
$userType = $_SESSION['userType'];
//add messages
require_once "../views/header.php";
$params   = $_SERVER['QUERY_STRING'];
if(isset($_POST['submit'])){
    $messageUpdate=$_POST['message'];
    if($messageUpdate !== "") {
        date_default_timezone_set("America/New_York");
        $time = date("Y-m-d h:i:sa");
        $xml = new DOMDocument();
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load("../xml/tickets.xml");
        $messages = $xml->getElementsByTagName('messages')->item($params-1);
        $message = $xml->createElement("message");
        $message->setAttribute("userId",$userId);
        $messageText = $xml->createElement("messageText", $messageUpdate);
        $time = $xml->createElement("date", $time);
        $message->appendChild($messageText);
        $message->appendChild($time);
        $messages->appendChild($message);
        $xml->save("../xml/tickets.xml");
        $comments_error =  "Thanks for your feedback!";
    }else{
        $comments_error = "please put some comments";
    }
}
if(isset($_POST['change'])) {
    $select = $_POST['status'];
    //if ($select == "close") {
    date_default_timezone_set("America/New_York");
    $timeClose = date("Y-m-d h:i:sa");
    //$_SESSION['status'] = 'Close';
    $xml = new DOMDocument();
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->load("../xml/tickets.xml");
    $ticket = $xml->getElementsByTagName('ticket')->item($params-1);
    $remove = $xml->getElementsByTagName("status")->item($params-1);
    $remove->parentNode->removeChild($remove);
    $new = $xml->createElement("status","Close");
    if($xml->getElementsByTagName("dateClose")->item($params-1) !== null){
        $removeStatus = $xml->getElementsByTagName("dateClose")->item($params-1);
        $removeStatus->parentNode->removeChild($removeStatus);
    }
    $timeClose = $xml->createElement("dateClose", $timeClose);
    $ticket->appendChild($timeClose);
    $ticket->appendChild($new);
    //$xml->documentElement->appendChild($ticket);
    $xml->save("../xml/tickets.xml");
    //}
}
?>
<?php
//display messages
$rows = '';
$displayMeg ='';
$params   = $_SERVER['QUERY_STRING'];
$xml = simplexml_load_file("../xml/tickets.xml");
$res = $xml->xpath("//ticket[@ticketId =$params]");
foreach ($res as $t){
    $rows .= '<tr>';
    $rows .= '<p class="ticketnum">'.'Ticket ID: '.$t->attributes()['ticketId'].'</p>'.'<br>';
    $rows .= '<td>'.'Messages: '.'<br>'.$t->subject.'</td>'.'<br>';
    $rows .= '<td>'.'Catalog: '.$t->catalog.'</td>'.'<br>';
    $rows .= '<td>'.'Date Opened: '.'<br>'.$t->dateOpen.'</td>'.'<br>';
    $rows .= '<td>'.'Date Closed: '.'<br>'.$t->dateClose.'</td>'.'<br>';
    if($userType == "admin"){
    $select = "";
    $rows .= '<td>' .'<form action="" method="post"><select name="status"><option value="close" <?= ($select == "close") ? "selected" : ""; ?>Close</option></select><button type="submit" name="change" class="button-status">Save</button> </form>'.'</td>';

}
    $rows .= '</tr>';

    $num = $t->messages->message;
    if($num==null){
        echo '<div class="time">' . "Create your first message if you have questions" ."</div>";
    }else{
        for($i=0; $i<count($num); $i++){
            $displayMeg .= '<div class="time">' . 'User Id: '. $t->messages->message[$i]->attributes()['userId'] ." | " . $t->messages->message[$i]->date .'</div>' . '<div class="content">'. $t->messages->message[$i]->messageText . '</div>';

        }
    }
}
if($id=null||$_SESSION['userType']==null){
    header('location:../views/userHome.php');
}
?>
<div class="container-table">
    <?php echo '<p class="welcome">Welcome Back ' . $_SESSION['username']. ' !</p>'; ?>
    <h1>Ticket Details</h1>
    <a href="listTicket.php" class="link-back">Back to tickets</a>
    <div class="wrapper">
        <div class="details">
            <?php print $rows ; ?>
        </div>
        <div class="message">
            <form action="" method="post">
                <input class="input-add"  placeholder="put your message here" name="message" />
                <span class="welcome"><?= isset($comments_error)? htmlspecialchars($comments_error): ''; ?></span>
                <button class="button-send" name="submit" type="submit">Message Us</button>
             </form>
            <div class="time"></div>
            <div>
                <?php print $displayMeg ;?>
            </div>
        </div>
    </div>
</div>
<script src="../js/script.js"></script>
<?php
require_once '../views/footer.php';
?>


