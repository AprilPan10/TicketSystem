<?php
require_once "../views/header.php";
session_start();
$id = $_SESSION['userId'];
date_default_timezone_set("America/New_York");
$time = date("Y-m-d h:i:sa");
$xml = simplexml_load_file("../xml/tickets.xml");
$i = $xml->xpath('//ticket[last()]');
$num='';
foreach ($i as $t){
    $num = $t->attributes()['ticketId'];
}
$num = $num + 1;
if(isset($_POST['submit'])){
$subject=$_POST['subject'];
$catalog = $_POST['catalog'];
if($subject !== "") {
    $xml = new DOMDocument();
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->load("../xml/tickets.xml");
    $ticket = $xml->createElement("ticket");
    $ticket->setAttribute("ticketId", $num);
    $ticket->setAttribute("userId", "$id");
    $catalog = $xml->createElement("catalog", $catalog);
    $subject = $xml->createElement("subject", $subject);
    $time = $xml->createElement("dateOpen", $time);
    $status = $xml->createElement("status", "Open");
    $messages = $xml->createElement("messages");
    $ticket->appendChild($status);
    $ticket->appendChild($subject);
    $ticket->appendChild($catalog);
    $ticket->appendChild($time);
    $ticket->appendChild($messages);
    $xml->documentElement->appendChild($ticket);
    $xml->save("../xml/tickets.xml");
    $comments_error =  "Thanks for your feedback!";
    }else{
    $comments_error = "please put some comments";
    }
}
if($id=null||$_SESSION['userType']==null){
    header('location:../views/userHome.php');
}

?>
<div class="container">
    <?php echo '<p class="welcome">Welcome Back ' . $_SESSION['username']. ' !</p>'; ?>
    <h1>Submit your ticket</h1>
    <form action="" method="post">
        <div>
            <label for="category" class="labeltitle">Category:</label>
            <div>
                <select class="select" name="catalog">
                    <option value="General">General</option>
                    <option value="Shipping">Shipping</option>
                    <option value="Return">Return</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>
        <div>
            <label for="subject" class="labeltitle">Subject:</label>
            <textarea name="subject" class="textbox" id="subject"></textarea>
        </div>
        <span class="welcome"><?= isset($comments_error)? htmlspecialchars($comments_error): ''; ?></span>
        <div>
            <button type="submit" value="submit" name="submit" class="button">SUBMIT TICKET</button>
        </div>
    </form>
</div>
<?php
require_once '../views/footer.php';
?>

