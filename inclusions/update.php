<?php
  if(!isset($_POST['update']))
  {
    header("Location: ../");
    exit();
  }
  include("db.php");
  session_start();
  $username = $_SESSION['username'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $age = $_POST['age'];
  $degree = $_POST['degree'];
  $favCourse = $_POST['favCourse'];
  $currentPassword = $_POST['currentPassword'];
  $newPassword = $_POST['newPassword'];
  $confirmPassword = $_POST['confirmPassword'];
  if(empty($name) || empty($surname) || empty($age) || empty($degree) || empty($favCourse))
  {
    header("Location: ../dashboard.php?update=blank");
    exit();
  }
  $sql = "SELECT * FROM tbl_users WHERE USERNAME=?;";
  $stmt = mysqli_stmt_init($connection);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $user = mysqli_stmt_get_result($stmt);
  $dbPassword = mysqli_fetch_assoc($user)['PASS'];
  $stmt = mysqli_stmt_init($connection);
  if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword))
  {
    $sql = "UPDATE tbl_users SET NAME=?, SURNAME=?, AGE=?, DEGREE=?, FAV_COURSE=? WHERE USERNAME=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssisss", $name, $surname, $age, $degree, $favCourse, $username);
  }
  else
  {
    if(!password_verify($currentPassword, $dbPassword))
    {
      header("Location: ../dashboard.php?update=incorrectPassword");
      exit();
    }
    if($newPassword != $confirmPassword)
    {
      header("Location: ../dashboard.php?update=passwordMismatch");
      exit();
    }
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE tbl_users SET PASS=?, NAME=?, SURNAME=?, AGE=?, DEGREE=?, FAV_COURSE=? WHERE USERNAME=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssisss", $passwordHash, $name, $surname, $age, $degree, $favCourse, $username);
  }
  mysqli_stmt_execute($stmt);
  header('Location: ../dashboard.php?update=success');
?>
