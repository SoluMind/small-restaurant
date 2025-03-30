<?php
session_start();
if (isset($_POST['login_action'])) {
require './connection.inc.php';


$userMail = $_POST['user_email'];
$userPasswd = $_POST['user_password'];

if(empty($userMail) || empty($userPasswd)) {
header("Location: ../login_orders_form.php?loginerror=emptyfields");
exit();
}
 // This is called Templating we check the user by username or useremail
$sql = "SELECT * FROM customer_orders WHERE uName=? OR uEmail=?";

$statement = $conn->stmt_init();
if(!$statement->prepare($sql)) {
  header("Location: ../login_orders_form.php?loginerror=sqlerror");
  exit();
}
// Bind the user input ($name) to the SQL query's parameter (to prevent SQL injection)
$statement->bind_param("ss", $userMail, $userMail);
$statement->execute();
if($statement->error) {
header("Location: ../login_orders_form.php?loginerror=servererror");
exit();
}

$result = $statement->get_result();

if($row = $result->fetch_assoc()) {
// This is called password_verify we check if the password is correct
  $passCheck = password_verify($userPasswd, $row['password']);
// If the password is not correct we display this
  if($passCheck == false) {
    header("Location: ../login_orders_form.php?loginerror=wronguserpwd");
    exit();
  }
  session_start();
  $_SESSION['u_id'] = $row['id'];
  $_SESSION['u_name'] = $row['uName'];

  // If the password is correct we display this
  header("Location: ../order.php?login=success");
  exit();
}
// If the user is not found we display this
else{
  header("Location: ../login_orders_form.php?loginerror=nonuser");
  exit();
}



// If the user is not found we display this
}else {
  header("Location: ../login_orders_form.php?loginerror=forbidden");
  exit();
}
?>