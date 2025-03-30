<?php
session_start();
if(isset($_POST['edit-submit'])  && isset($_SESSION['IdUsers'])) { // Check if the form has been submitted and if the user is logged in
  require './connection.inc.php';

// Store form data in variables
  $id = $_GET['id'];
  $title = $_POST['title'];
  $imageUrl = $_POST['imageurl'];
  $comment = $_POST['comment'];

  // Check if any of the required fields are empty
  if(empty($id) || empty($title) || empty($imageUrl) || empty($comment)) {
    header("Location: ../editpost.php?id=$id&error=emptyfields");
    exit();
  }

  // Prepare the SQL statement to update the post
  $sql = "UPDATE postUser SET title=?,imageurl=?,comment=? WHERE postUid=?;";

  // Initialize a statement and prepare the SQL query
  $statement = $conn->stmt_init();
    if(!$statement->prepare($sql)) { // Check if the preparation failed
    header("Location: ../editpost.php?if=$id&error=sqlerror");
  exit();
  }
 // Bind the parameters to the SQL query
$statement->bind_param("sssi", $title, $imageUrl, $comment, $id);

  // Execute the SQL query
$statement->execute();

  // Check if there was an error during execution
if($statement->error) {
 header("Location: ../editpost.php?id=$id&error=servererror");
 exit();
}

 // If everything is successful, redirect to the posts page with a success message.
header("Location: ../posts.php?id=$id&edit=success");
exit();
// Close the statement and the database connection
$statement->close();
$conn->close();


}else {
    // If the form was not submitted or the user is not logged in, redirect to the post page with an error message
  header("Location: ../post.php?error=forbidden");
}

?>