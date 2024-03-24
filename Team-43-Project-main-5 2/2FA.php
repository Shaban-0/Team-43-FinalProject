<?php
//sends random 6 digit passcode to user' email after they're credentialds have been verified
//verify user login details before doing this
session_start();

//random 6 digit passcode generated
$passcode = strval(random_int(100000, 999999));

//may consider using phpmailer as it is more reliable
function sendEmail($email, $passcode){
    $recipient = "";
    $subject = "Login Passcode For Paradise";
    $message = "Your passcode is: $passcode";
    $headers = "From: audreyntelah@gmail.com\r\n";
    $mailSent = mail($recipient, $subject, $message, $headers);

    if ($mailSent){
        echo "Email sent successfully";
    }else{
        echo "Failed to send email";
    }
}

//email sent
//if ($_SERVER["REQUEST_METHOD"] == "POST") $email = $_POST["email"];
$email = ""; //get users email

//session stores passcode and time
$_SESSION['passcode'] = $passcode;
$_SESSION['expiration_time'] = time();

sendEmail($email, $passcode);


//validate passcode user entered
//add if statement that gets enteredpasscode
$enteredPasscode = $_GET["passcode"];

if (isset($_SESSION["passcode"]) && isset($_SESSION["timestamp"])) {
    $storedPasscode = $_SESSION["passcode"];
    $timestamp = $_SESSION["timestamp"];

    if ($enteredPasscode == $storedPasscode && time() - $timestamp <= 300) {
        echo "Passcode is valid";
        //take to user page
    } else if ($enteredPasscode != $storedPasscode){
        echo "Passcode is invalid";
        //take back to login page
        //header('Location: login.php');
    } else if (time() - $timestamp > 300){
        echo "Passcode has expired";
        //take back to login page
        //header('Location: login.php');
    } else{
        echo "Passcode is invalid or expired";
        //take back to login page
        //header('Location: login.php');
    }
    unset($_SESSION["passcode"]);
    unset($_SESSION["timestamp"]);

} else {
    echo "Passcode validation failed.";
}
?>