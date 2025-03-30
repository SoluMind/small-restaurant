<!-- HEADER.PHP -->
<?php
  require './templates/header.php';
?>

  <main class="container p-4 bg-light mt-3">
    <!-- Error handling we have to display to the user -->
    <?php
    // Check if there's an error in the URL (related to post deletion)
    if(isset($_GET['error'])){
        // Handle server or database errors
        if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
            $errorMsg = "An internal server error has occurred - please try again later";
        }

        // Display the error message
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

    // Check if a post was successfully created
    } else if(isset($_GET['post']) && $_GET['post'] == "success"){
        echo '<div class="alert alert-success" role="alert">
            Post created!
        </div>';

    // Check if a post was successfully edited
    } else if(isset($_GET['edit']) && $_GET['edit'] == "success"){
        echo '<div class="alert alert-success" role="alert">
            Post edited!
        </div>';

    // Check if a post was successfully deleted
    } else if (isset($_GET['delete']) && $_GET['delete'] == "success"){
        echo '<div class="alert alert-success" role="alert">
            Post successfully deleted!
        </div>';
    }
?>


<?php
// Include the database connection file
require './includes/connection.inc.php';

// Define the SQL query to select the necessary fields from the 'postUser' table
$sql = "SELECT postUid, title, imageurl, comment FROM postUser";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query returned any rows (i.e., if there are posts in the database)
if ($result->num_rows > 0) {
  // If posts are available, initialize an empty string to store the HTML output
  $output = "";

  // Loop through each row in the result set and build the HTML for each post
  // Note: We use .= to append to the $output string instead of replacing it
  while ($row = $result->fetch_assoc()) {
    // Create a card for each post with its image, title, and comment
    $output .= '<div class="row" id="' . $row['postUid'] . '">
    <div class="col-6 d-flex justify-content-center">
      <div class="card">
        <img src="' . $row['imageurl'] . '" class="card-img-top" alt="' . $row['title'] . '">
      </div>
    </div>
    <div class="col-6 d-flex justify-content-center align-items-center">
      <div class="card-body
      text-center">
        <h5 class="card-title">' . $row['title'] . '</h5>
        <p class="card-text">' . $row['comment'] . '</p>
      </div>
    </div>
  </div>';

    // If the user is logged in (determined by checking if the session variable 'IdUsers' is set),
    // provide options to edit or delete the post
    if (isset($_SESSION['IdUsers'])) {
      $output .= '<div class="admin-btn">
      <a href="editpost.php?id=' . $row['postUid'] . '" class="btn btn-dark mt-2">Edit</a>
      <a href="includes/deletepost.inc.php?id=' . $row['postUid'] . '" class="btn btn-danger mt-2">Delete</a>
     </div>';
    }
  }

  // Close the last div tags and add the remaining HTML to the output
  $output .= '</div>
             </div>';

  // Echo the final HTML output to display the posts
  echo $output;

} else {
  // If no posts are found, output a message indicating that there are no results
  echo "0 result";
}

// Close the database connection
$conn->close();

?>


</main>




<!-- FOOTER.PHP -->
<?php
  require './templates/footer.php';
?>