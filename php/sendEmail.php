<?php

// Replace this with your own email address
$to = 'rahulsinghpilani7@gmail.com';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

ob_start(); // Start output buffering

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim(stripslashes($_POST['name']));
    $phone = trim(stripslashes($_POST['phone']));
    $email = trim(stripslashes($_POST['email']));
    $location_from = trim(stripslashes($_POST['location_from']));
    $location_to = trim(stripslashes($_POST['location_to']));

    // Set Subject
    $subject = "Quote Request - $name";

    // Set Message
    $message = "Name: $name <br />";
    $message .= "Phone: $phone <br />";
    $message .= "Email: $email <br />";
    $message .= "Location From: $location_from <br />";
    $message .= "Location To: $location_to <br />";
    $message .= "<br /> ----- <br /> This email was sent from your site " . url() . " contact form. <br />";

    // Set From: header
    $from = "$name <$email>";

    // Email Headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    ini_set("sendmail_from", $to); // for windows server
    $mail = mail($to, $subject, $message, $headers);

    if ($mail) {
        echo "OK";
    } else {
        echo "Something went wrong. Please try again.";
    }
} else {
    // If the form is not submitted through POST method, redirect to the form page.
    header("Location: index.html");
    exit();
}

ob_end_flush(); // End output buffering and flush the output
?>
