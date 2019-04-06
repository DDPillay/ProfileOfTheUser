<!DOCTYPE=html>
<html>
    <head>
        <title>Authentication System</title>
        <link type="text/css" href="inclusions/style.css" rel="stylesheet">
    </head>
    <body>
        <br>
        <form method="post" action="inclusions/signUp.php" id="formSignUp">
            <h2>Sign Up</h2><br>
            <label>Username:</label>
            <input type="text" name="username" placeholder="Username"><br>
            <label>Name:</label>
            <input type="text" name="name" placeholder="Name"><br>
            <label>Surname:</label>
            <input type="text" name="surname" placeholder="Surname"><br>
            <label>Age:</label>
            <input type="number" name="age" min="0" max="100"><br>
            <label>Degree:</label>
            <input type="text" name="degree" placeholder="Degree"><br>
            <label>Favourite Course:</label>
            <input type="text" name="favCourse" placeholder="Favourite Course"><br>
            <label>Password:</label>
            <input type="password" name="password"><br>
            <label>Confirm password:</label>
            <input type="password" name="confirmPassword"><br>
            <button type="submit" name="signUp" value="submit">Sign Up</button><br>
            <a href="index.php">Sign In</a>
        </form>
    </body>
</html>

<?php
  if(isset($_GET['signUp']))
  {
    switch($_GET['signUp'])
    {
      case "blank": echo("<p>Please fill out all fields.<p>");
      break;
      case "passwordMismatch": echo("<p>Passwords do not match.<p>");
      break;
      case "duplicate": echo("<p>That username is already taken. Please try again.<p>");
      break;
    }
  }
?>
