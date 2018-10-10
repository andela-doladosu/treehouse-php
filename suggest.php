<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
    $email =  trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $details =  trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($name) || empty($email) || empty($details)) {
        echo "Please fill in the required fields: name, email and details";
        exit;
    }

    echo "<pre>";
    $emailBody = "";
    $emailBody .= "Name: ". $name. "\n";
    $emailBody .= "Email: ". $email. "\n";
    $emailBody .= "Details: ". $details. "\n";
    echo $emailBody;
    echo "</pre>";

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
