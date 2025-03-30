<?php
// Check if the submit button is clicked
if (isset($_POST['signup-submit'])) {
  // Include database connection
  require './connection.inc.php';

  // Escape user input for security
  $userName = $conn->real_escape_string($_POST['uid']);
  $email = $conn->real_escape_string($_POST['mail']);
  $password = $conn->real_escape_string($_POST['pwd']);
  $passwordConfirm = $conn->real_escape_string($_POST['pwd-repeat']);

  // Password regex for strong password validation
  $passwordRegex = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

  // Check for empty fields
  if (empty($userName) || empty($email) || empty($password) || empty($passwordConfirm)) {
    header("Location: ../signup.php?error=emptyfields&uid=$userName&mail=$email");
    exit();
  }

  // Check for valid username and email
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $userName) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmailuid");
    exit();
  }

  // Check for valid username
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
    header("Location: ../signup.php?error=invaliduid&mail=$email");
    exit();
  }

  // Check for valid email like using @ and .com
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=$userName");
    exit();
  }

  // Check for strong password
  else if (!preg_match($passwordRegex, $password)) {
    header("Location: ../signup.php?error=invalidpwd&uid=$userName&mail=$email");
    exit();
  }

  // Check if passwords match
  else if ($password !== $passwordConfirm) {
    header("Location: ../signup.php?error=passwordcheck&uid=$userName&mail=$email");
    exit();
  } else {
    //  1. First round to check the user dublicate and binding
    $sql = "SELECT username  FROM users WHERE username=?;";

    $statement = $conn->stmt_init();
    if (!$statement->prepare($sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    // this is step one binding
    $statement->bind_param("s", $userName);

    $statement->execute();
    if ($statement->error) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    $statement->store_result();

    $resultCheck = $statement->num_rows();
    if ($resultCheck > 0) {
      header("Location: ../signup.php?error=usertaken&" . $email);
      exit();
    } else {
      //  2. This second round is to save the user DB
      $sql = "INSERT INTO users( username, userEmail, Userpwd) VALUES (?,?,?)";

      $statement = $conn->stmt_init();
      if (!$statement->prepare($sql)) {
        header("Location: ../signup.php?error=servererror");
        exit();
      }

      // Password hashed it's not good idea to leave it as plain text we have to encrypt
      $passWordHashed = password_hash($password, PASSWORD_DEFAULT);
      $statement->bind_param("sss", $userName, $email, $passWordHashed);
      $statement->execute();
      if ($statement->error) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }
      header("Location: ../signup.php?signup=success");
      exit();
    }
  }

  $statement->close();
  $conn->close();
} else {
  // Redirect if the form is not submitted
  header('Location: ../signup.php?error=forbidden');
  exit();
}
