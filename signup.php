<!-- HEADER.PHP -->
<?php
require './templates/header.php';
?>

<main class="container p-4 bg-light mt-3">
  <!-- signup.inc.php - Will process the data from this form-->
  <form action="includes/signup.inc.php" method="POST">
    <h2>Register Here</h2>






    <?php
    // This called gracfully error handling we doisplay to user if somthing is wrong
    if (isset($_GET['error'])) {

      if ($_GET['error'] == "emptyfields") {
        $errorMsg = "Please fill in all fields";

        // (1) NonUser or invalid user  Email AND Password
      } else if ($_GET['error'] == "invalidmailuid") {
        $errorMsg = "Invalid email and Password";

        // (2) Invalid Email
      } else if ($_GET['error'] == "invalidmail") {
        $errorMsg = "Invalid email";

        // (3) Invalid Username
      } else if ($_GET['error'] == "invaliduid") {
        $errorMsg = "Invalid username";

        // (4) Invalid Password
      } else if ($_GET['error'] == "invalidpwd") {
        $errorMsg = "Invalid password - you need to create a password with at least 1 capital letter, 1 number & 1 special character";

        // (5) Password Confirmation Error
      } else if ($_GET['error'] == "passwordcheck") {
        $errorMsg = "Passwords do not match";

        // (6) Username MATCH in database on save
      } else if ($_GET['error'] == "usertaken") {
        $errorMsg = "Username already taken";

        // (7) Internal server error
      } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "An internal server error - please try again later";
      }
      // If we have error above  we display this
      echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

      // Otherwise we display Success message
    } else if (isset($_GET['signup'])) {
      echo '<div class="alert alert-success" role="alert">You have successfully registerd !</div>';
    }


    ?>



    <!-- 1. USERNAME -->
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="uid" placeholder="Username" value=<?php if (isset($_GET['uid'])) {
      // If the user success we send them this match with username above
      echo $_GET['uid'];
                                                                                      } ?>>
    </div>

    <!-- 2. EMAIL -->
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="mail" placeholder="Email Address">
    </div>

    <!-- 3. PASSWORD -->
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="pwd" placeholder="Password">
    </div>

    <!-- 4. PASSWORD CONFIRMATION -->
    <div class="mb-3">
      <label for="password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
    </div>

    <!-- 5. SUBMIT BUTTON -->
    <button type="submit" name="signup-submit" class="btn btn-dark w-100">Signup</button>
  </form>
</main>

<!-- FOOTER.PHP -->
<?php
require './templates/footer.php';
?>