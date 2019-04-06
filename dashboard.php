<html>
  <head>
    <title>User Dashboard</title>
    <link type="text/css" href="inclusions/style.css" rel="stylesheet">
  </head>
  <body>
    <?php
      session_start();
      if(isset($_SESSION['username']))
      {
        include("inclusions/db.php");
        $username = $_SESSION['username'];
        echo("<p>Welcome $username.</p>");
        $sql = "SELECT * FROM tbl_users WHERE USERNAME=?;";
        $stmt = mysqli_stmt_init($connection);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        echo('<form method="post" action="inclusions/update.php" id="dashboard">
                <h2>Edit Profile</h2><br>
                <p>NB. If you do not want to edit your password, please leave the password fields blank.<p>
                <label>Username:</label>
                <input type="text" name="username" value="'.$username.'" disabled="true"><br>
                <label>Name*:</label>
                <input type="text" name="name" value="'.$user['NAME'].'"><br>
                <label>Surname*:</label>
                <input type="text" name="surname" value="'.$user['SURNAME'].'"><br>
                <label>Age*:</label>
                <input type="number" name="age" min="0" max="100" value="'.$user['AGE'].'"><br>
                <label>Degree*:</label>
                <input type="text" name="degree" value="'.$user['DEGREE'].'"><br>
                <label>Favourite Course*:</label>
                <input type="text" name="favCourse" value="'.$user['FAV_COURSE'].'"><br>
                <label>Current Password:</label>
                <input type="password" name="currentPassword"><br>
                <label>New Password:</label>
                <input type="password" name="newPassword"><br>
                <label>Confirm password:</label>
                <input type="password" name="confirmPassword"><br>
                <button type="submit" name="update" value="submit">Update Details</button><br>
                <a href="index.php?signOut=success">Sign out</a>
              </form>');
            if(isset($_GET['update']))
            {
              switch($_GET['update'])
              {
                case "blank": echo("<p>Please fill in all required (*) fields.</p>");
                break;
                case "incorrectPassword": echo("<p>The password you have provided is incorrect.</p>");
                break;
                case "passwordMismatch": echo("<p>Passwords do not match.</p>");
                break;
                case "success": echo("<p>Update successful.</p>");
                break;
              }
            }
      }
      else
      {
        header("Location: index.php");
      }
    ?>
  </body>
</html>
