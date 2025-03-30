<!-- HEADER.PHP -->
<?php
  require "templates/header.php"
?>

  <main class="container p-4 bg-light mt-3">
    <!-- createpost.inc.php - Will process the data from this form-->
    <form action="includes/createpost.inc.php" method="POST">
      <h2>Create Post</h2>

<?php
      // error=servererror
    if(isset($_GET['error'])){
      // error=forbidden
      if($_GET['error'] == 'forbidden'){
        $errorMsg = "Access denied - please submit form correctly";
      }
      // error=emptyfields
      else if($_GET['error'] == 'emptyfields'){
        $errorMsg = "Please fill in all fields";
      }
      // error=sqlerror || error=servererror
      else if ($_GET['error'] == "sqlerror" || $_GET['loginerror'] == "servererror") {
        $errorMsg = "An internal server error has occurred - please try again later";
      }

      // Echo Back Danger Alert with the Dynamic Error Message as we definitely have an error!
      echo '<div class="alert alert-danger" role="alert">'. $errorMsg .'</div>';

    }

      ?>

      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title" value="">
      </div>

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment" ></textarea>
      </div>
      <!-- <div class="mb-3">
        <label for="imageurl" class="form-label">post Image </label>
        <input type="text" class="form-control" name="post-image" placeholder="Image URL" value="" >
      </div> -->

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="post-submit" class="btn btn-dark w-100">Post</button>
    </form>
  </main>

<!-- FOOTER.PHP -->
<?php
  require "templates/footer.php"
?>