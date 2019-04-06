<?php
  if(!isset($_POST['signUp']))
  {
    header("Location: ../");
    exit();
  }
  include("db.php");
  $username = $_POST['username'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $age = $_POST['age'];
  $degree = $_POST['degree'];
  $favCourse = $_POST['favCourse'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  if(empty($username) || empty($name) || empty($surname) || empty($age) || empty($degree) || empty($favCourse)|| empty($password) || empty($confirmPassword))
  {
    header("Location: ../signUp.php?signUp=blank");
    exit();
  }
  if($password != $confirmPassword)
  {
    header("Location: ../signUp.php?signUp=passwordMismatch");
    exit();
  }
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO tbl_users (USERNAME, PASS, NAME, SURNAME, AGE, DEGREE, FAV_COURSE) VALUES (?,?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($connection);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "ssssiss", $username, $passwordHash, $name, $surname, $age, $degree, $favCourse);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_affected_rows($stmt) == -1)
  {
    header("Location: ../signUp.php?signUp=duplicate");
    exit();
  }
  header("Location: ../index.php?signUp=success");
?>
