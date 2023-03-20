<?php
$dbHost = 'localhost';
$dbName = 'task';
$dbUser = 'root';
$dbPass = '';

$mailid    = filter_input(INPUT_POST, 'mailid', FILTER_SANITIZE_EMAIL);
$pass_word = filter_input(INPUT_POST, 'pass_word', FILTER_SANITIZE_STRING);

try {
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("SELECT mailid,pass_word FROM register WHERE mailid=:mailid AND pass_word=:pass_word");
  $stmt->bindParam(':mailid', $mailid);
  $stmt->bindParam(':pass_word', $pass_word);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if($user) {
    echo json_encode(array('success' => true));
  } else {
    echo json_encode(array('success' => false, 'error' => 'Invalid mailid or pass_word'));
  }
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>