<!-- HEADER.PHP -->
<?php
  require "templates/header.php";

?>
<!-- HEADER.PHP -->
<?php
     if(isset($_SESSION['IdUsers']) && isset($_GET['id'])) {
   require './includes/connection.inc.php';

   $id = $conn->real_escape_string($_GET['id']);
   $id = intval($id);

  $sql = "SELECT title, imageurl, comment FROM postUser WHERE postUid=?;";

  $statement = $conn->stmt_init();
  if(!$statement->prepare($sql)) {
  header("Location: ./posts.php?id=$id&error=sqlerror");
  exit();
  }

  $statement->bind_param("i", $id);
  $statement->execute();
  $result = $statement->get_result();

  if(!$result) {
    header("Location: ./posts.php?id=$id&error=servererror");
    exit();
  }
  $row = $result->fetch_assoc();

    }else {
      header("Location: ./index.php?error=forbidden");
      exit();
    }

    ?>


  <main class="container p-4 bg-light mt-3">


<!-- Note we pass  echo $id  we'll use this id in our file editpost.inc.php-->
    <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="POST">
      <h2>Edit Post</h2>
      <?php

    // Check if there is an error parameter in the URL query string
    if(isset($_GET['error'])){

          // If the error is 'emptyfields', set an appropriate error message
      if($_GET['error'] == 'emptyfields'){
          $errorMsg = "Please fill in all fields";
      }
      // If the error is 'sqlerror' or 'servererror', set a generic internal server error message
      else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
          $errorMsg = "An internal server error has occurred - please try again later";
      }

    // Display an alert box with the error message
    echo '<div class="alert alert-danger" role="alert">'. $errorMsg .'</div>';
}

?>




      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title'] ?>">
      </div>

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['imageurl'] ?>" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment"><?php echo $row['comment'] ?></textarea>
      </div>

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="edit-submit" class="btn btn-dark w-100">Edit</button>
    </form>
  </main>

<!-- FOOTER.PHP -->
<?php
  require "templates/footer.php";
?>
