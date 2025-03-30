<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbName = 'blog_database';


$conn = new mysqli($servername, $username, $password, $dbName);
if ($conn->connect_error) {
  die("<h4 style='color: red'>Connection failed: " . $conn->connect_error . "</h4>");
}
if(!$conn){
  die('<div class="alert alert-warning mt-3" role="alert"><h4>Connection Failed</h4>'. mysqli_connect_error().'</div>');
}
echo '<div class="alert alert-success mt-3" role="alert">Connection Successful</div>';
?>



