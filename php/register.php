<?php
$dbHost = 'localhost';
$dbName = 'task';
$dbUser = 'root';
$dbPass = '';

$username     = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$mailid    = filter_input(INPUT_POST, 'mailid', FILTER_SANITIZE_EMAIL);
$pass_word = filter_input(INPUT_POST, 'pass_word', FILTER_SANITIZE_STRING);

try {
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("INSERT INTO register (username, mailid, pass_word) VALUES (:username, :mailid, :pass_word)");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':mailid', $mailid);
  $stmt->bindParam(':pass_word', $pass_word);
  $stmt->execute();

  echo json_encode(array('success' => true));
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>
