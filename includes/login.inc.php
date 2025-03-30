<?php
ob_start();
// Check the form is submitted correctly
if (isset($_POST['login-submit'])) {
  // Connect to the db
  require './connection.inc.php';

  $emailUser = $_POST['mailuid'];
  $passwordUser = $_POST['pwd'];

  if (empty($emailUser) || empty($passwordUser)) {
    header("Location: ../index.php?loginerror=emptyfields");

    exit();
  }
  // This is called Templating we check the user by username or useremail

  // Templating start
  else {

    $sql = "SELECT * FROM users WHERE username=? OR userEmail=?";
    $statement = $conn->stmt_init();
    if (!$statement->prepare($sql)) {
      header("Location: ../index.php?loginerror=sqlerror");
      exit();
    }
    // Templating Finish here

    // Execution start
    else {
      $statement->bind_param("ss", $emailUser, $emailUser);
      $statement->execute();
      if ($statement->error) {
        header("Location: ../index.php?loginerror=servererror");

        exit();
      }

      $result = $statement->get_result();
      if ($row = $result->fetch_assoc()) {
        // That is how to check password with row which we call UserPwd means we grap from our database
        $passWordCheck = password_verify($passwordUser, $row['Userpwd']);

        // If our Passwod is fail or wrong we send user to index
        if (!$passWordCheck) {
          header("Location: ../index.php?loginerror=wronguserpwd");
          exit();
        }

        // if we have those error above we Give user SUCCESS MESSAGE. then we have to access Session_start superglobal
        else if ($passWordCheck == true) {
          session_start();
          $_SESSION['IdUsers'] = $row['id'];
          $_SESSION['uidUsers'] = $row['username'];
          // SUCCESS MESSAGE User we send them to index.php file

          header("Location: ../index.php?login=success");
          exit();

        } else {
          header("Location: ../index.php?loginerror=wronguserpwd");
          exit();
        }
      } else {
        // User has NOT submitted form correctly
        header("Location: ../index.php?loginerror=forbidden");

        exit();
      }
    }
  }
}
ob_end_flush();
