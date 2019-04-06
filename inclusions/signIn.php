<?php
  if(!isset($_POST['signIn']))
  {
    header("Location: ../");
    exit();
  }
  include("db.php");
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM tbl_users WHERE USERNAME=?;";
  $stmt = mysqli_stmt_init($connection);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $user = mysqli_stmt_get_result($stmt);
  if(mysqli_num_rows($user) == 0)
  {
    header("Location: ../index.php?signIn=none");
    exit();
  }
  $user = mysqli_fetch_assoc($user);
  if(password_verify($password, $user['PASS']))
  {
    session_start();
    $_SESSION['username'] = $username;
    header("Location: ../dashboard.php");
    exit();
  }
  header("Location: ../index.php?signIn=invalid");
?>
