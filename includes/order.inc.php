<?php
if (isset($_POST['submit'])) {
    // Connect to datbase
require './connection.inc.php';

$name = $conn->real_escape_string ($_POST['userName']);
$email = $conn->real_escape_string($_POST['userMail']);
$password = $conn->real_escape_string($_POST['userPassword']);
$passwordRegex = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

if(empty($name) || empty($email) || empty($password)){
    header("Location: ../order_form.php?error=emptyfields&name=" . $name . "&email=" . $email);
    exit();
}

if (!preg_match("/^[a-zA-Z0-9]*$/", $name) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Both name and email are invalid
    header("Location: ../order_form.php?error=invalidname&invalidemail");
    exit();
} elseif (!preg_match("/^[a-zA-Z0-9]*$/". $name)) {
    // Name is invalid
    header("Location: ../order_form.php?error=invalidName&email=" . $email);
    exit();
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Email is invalid
    header("Location: ../order_form.php?error=invalidEmail&name=" . $name);
    exit();
} elseif (!preg_match($passwordRegex, $password)) {
    // Password is invalid
    header("Location: ../order_form.php?error=invalidPasswd&name=" . $name . "&email=" . $email);
    exit();
}

else {
// Prepare an SQL query to check if a user with the given name already exists in the 'orders' table
$sql = "SELECT uName FROM customer_orders WHERE uName=?;";

// Initialize a prepared statement
$statement = $conn->stmt_init();

// Check if the SQL statement preparation fails
if (!$statement->prepare($sql)) {
    // Redirect to index.php with an 'sqlerror' parameter if there's an error preparing the statement
    header("Location: ../order_form.php?error=sqlerror");
    exit();
}

// Bind the user input ($name) to the SQL query's parameter (to prevent SQL injection)
$statement->bind_param("s", $name);

// Execute the prepared statement to check for existing records in the database
$statement->execute();
   // Check for errors after execution
if($statement->error) {
header("Location: ../order_form.php?error=servererror");
exit();
}
// Store result to check if user already exists
$statement->store_result();
$resultCheck = $statement->num_rows();
if($resultCheck > 0) {
header("Location: ../order_form.php?error=usertaken&email=" . $email);
exit();

}else {
    // Prepare a statement to insert a new user
$sql = "INSERT INTO customer_orders( uName, uEmail, password) VALUES (?,?,?)";
// Reuse the same prepared statement or initialize a new one
$statement = $conn->stmt_init();
if(!$statement->prepare($sql)) {
    header("Location: ../order_form.php?error=errorInsertData");
exit();
}
// Hash the password and bind parameters
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$statement->bind_param("sss", $name, $email, $passwordHash);
$statement->execute();
if($statement->error) {
header("Location: ../order_form.php?error=sqlerror");
exit();
}
// Redirect to order.php with a success parameter
header("Location: ../order.php?signup=success");
exit();


  }

}


}else{
    header("Location: ../index.php?error=forbidden");
    exit();
}
?>
