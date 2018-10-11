<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once 'vendor/PHPMailer-master/src/PHPMailer.php';
require_once 'vendor/PHPMailer-master/src/Exception.php';
require_once 'vendor/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
    $email =  trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $details =  trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($name) || empty($email) || empty($details)) {
        echo "Please fill in the required fields: name, email and details";
        exit;
    }

    if (!PHPMailer::validateAddress($email)) {
        echo "invalid email address";
        exit;
    }

    $emailBody = "";
    $emailBody .= "Name: ". $name. "\n";
    $emailBody .= "Email: ". $email. "\n";
    $emailBody .= "Details: ". $details. "\n";

    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "daradosu@gmail.com";
    //Password to use for SMTP authentication
    $mail->Password = "vgjounldthwafthf";

    //It's important not to use the submitter's address as the from address as it's forgery,
    //which will cause your messages to fail SPF checks.
    //Use an address in your own domain as the from address, put the submitter's address in a reply-to
    $mail->setFrom('daradosu@gmail.com', $name);
    $mail->addAddress('daradosu@gmail.com', 'Dara Receiver');
    $mail->addReplyTo($email, $name);
    $mail->Subject = "Library Suggestion from $name";
    $mail->Body = $emailBody;

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;

        echo "<h1>mail send error</h1>";
        exit;
    }

    header("location:suggest.php?status=thanks");
}

$pageTitle = "Suggest a Media Item";
$section = 'suggest';
include("inc/header.php");
?>

<div class="section page">
    <div class="wrapper">
        <h1>Suggest a Media Item</h1>
        <?php if (isset($_GET['status']) && $_GET['status'] === 'thanks') {
            echo "<p>Thanks for the email. I&rsquo;ll check out your suggestion shortly.</p>";
        } else { ?>
        <p>If you think there is something I'm missing, please let me know. Complete the form to send me an email.</p>
        <form method="post">
            <table>
                <tr>
                    <th><label for="name">Name</label></th>
                    <td><input type="text" id="name" name="name" /></td>
                </tr>
                <tr>
                    <th><label for="email">Email</label></th>
                    <td><input type="text" id="email" name="email" /></td>
                </tr>
                <tr>
                    <th><label for="details">Suggest item details</label></th>
                    <td><textarea id="details" name="details"></textarea></td>
                </tr>
            </table>
            <input type="submit" value="send" />
        </form>
        <?php } ?>
    </div>
</div>
<?php include("inc/footer.php"); ?>
