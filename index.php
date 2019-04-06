<!DOCTYPE=html>
<html>
    <head>
        <title>Authentication System</title>
        <link type="text/css" href="inclusions/style.css" rel="stylesheet">
    </head>
    <body>
        <br>
        <form method="post" action="inclusions/signIn.php" id="formSignIn">
            <h2>Sign In</h2><br>
            <label>Username:</label>
            <input type="text" name="username" placeholder="Username"><br>
            <label>Password:</label>
            <input type="password" name="password"><br>
            <button type="submit" name="signIn" value="submit">Sign In</button><br>
            <a href="signUp.php">Create Account</a>
        </form>
    </body>
</html>

<?php
  if(isset($_GET['signIn']))
  {
    switch($_GET['signIn'])
    {
      case "none": echo("<p>Username not found.<p>");
      break;
      case "invalid": echo("<p>Password incorrect.<p>");
      break;
    }
  }
  elseif(isset($_GET['signUp']))
  {
    echo("<p>Congratulations. You have been signed up. Please sign in.<p>");
  }
  elseif(isset($_GET['signOut']))
  {
    session_start();
    session_destroy();
    echo("<p>You have been successfully signed out.<p>");
  }
?>
