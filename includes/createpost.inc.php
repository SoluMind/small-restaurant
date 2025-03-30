<?php
session_start();
if(isset($_POST['post-submit']) && isset($_SESSION['IdUsers'])){
require './connection.inc.php';

$title = $_POST['title'];
$imageUrl = $_POST['imageurl'];
$comment = $_POST['comment'];


if(empty($title) || empty($imageUrl) || empty($comment)) {
  header("Location: ../createpost.php?error=emptyfields");
  exit();
}

$sql = "INSERT INTO postUser(postUid, title, imageurl, comment) VALUES (NULL,?,?,?)";
$statement = $conn->stmt_init();
if(!$statement->prepare($sql)) {
  header("Location: ../createpost.php?error=sqlerror");
  exit();
}
$statement->bind_param("sss", $title, $imageUrl, $comment);
$statement->execute();
if($statement->error){
  header("Location: ../createpost.php?error=servererror");
  exit();
}
header("Location: ../posts.php?post=success");
exit();


}else {
  header("Location: ../createpost.php?error=forbidden");
  exit();
}





?>