<?php

date_default_timezone_set('Etc/UTC');
error_reporting(E_ALL);
ini_set('display_errors', '1');

require "PHPMailer/PHPMailerAutoload.php";

if (isset($_POST['name']) && isset($_POST['email'])) {

  if (empty($_POST['name']) || empty($_POST['email'])) {
    $data = array('success' => false, 'message' => 'Please fill out the form completely.');
    echo json_encode($data);
    exit;
  }

  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = isset($_POST['phone']) ? $_POST['phone'] : 'Phone not provided.';
  $department = isset($_POST['department']) ? $_POST['department'] : 'Department not provided.';

  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPDebug = 0;
  $mail->Debugoutput = 'html';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  
  $mail->Username = "mauricio@xubliminal.com";
  $mail->Password = "Qwerty1123581321";
  $mail->setFrom('hello@xubliminal.com');
  $mail->addAddress('mauricio@xubliminal.com', 'Mauricio Gamboa');
  $mail->addAddress('julian@xubliminal.com', 'Julian Solano');
  $mail->Subject = 'Credito Activado';
  $mail->Body = "From: $name\n\nE-Mail: $email\n\nPhone: $phone\n\nDepartment: $department";

  if (!$mail->send()) {
    $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
    echo json_encode($data);
    exit;
  }
  
  $data = array('success' => true, 'message' => 'Thanks! We have received your message.');
  echo json_encode($data);

} else {
  $data = array('success' => false, 'message' => 'Please fill out the form completely.');
  echo json_encode($data);
}