<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Enkripsi MD5

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $user;
    echo json_encode(['status' => 'success', 'role' => $user['role']]);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Login gagal']);
  }
}
?>
