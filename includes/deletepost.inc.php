<?php
// Start the session to access session variables
session_start();

// Check if the 'IdUsers' session variable is set and if the 'id' GET parameter is provided
if(isset($_SESSION['IdUsers']) && isset($_GET['id'])) {

    // Include the database connection file
    require './connection.inc.php';

    // Escape and validate the 'id' GET parameter to prevent SQL injection
    $id = $conn->real_escape_string($_GET['id']);

    // $id = intval($id);

    // Prepare the SQL query to delete a post from the 'postUser' table
    $sql = "DELETE FROM postUser WHERE postUid=?";

    // Initialize a statement object
    $statment = $conn->stmt_init();

    // Check if the statement preparation fails
    if(!$statment->prepare($sql)) {
        // Redirect to the posts page with an SQL error message
        header("Location: ../posts.php?id=$id&error=sqlerror");
        exit();
    }

    // Bind the 'id' parameter to the prepared statement
    $statment->bind_param("i", $id);

    // Execute the prepared statement
    $statment->execute();

    // Check if there was an error during execution
    if($statment->error) {
        // Redirect to the posts page with a server error message
        header("Location: ../posts.php?error=servererror");
        exit();
    }

    // Redirect to the posts page with a success message
    header("Location: ../posts.php?id=$id&delete=success");
    exit();

} else {
    // If the session variable or GET parameter is not set, redirect to the signup page
    header("Location: ../signup.php?error=forbidden");
    exit();
}
?>