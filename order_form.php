<?php require './templates/header.php' ?>
  <!-- New Form: START -->
  <section class="container mt-5">
    <form action="includes/order.inc.php" method="POST">


    <?php
    // This called gracfully error handling we doisplay to user if somthing is wrong
    if (isset($_GET['error'])) {

      if ($_GET['error'] == "emptyfields") {
        $errorMsg = "Please fill in all fields";

        // (1)  invalid user  Email AND Password
      } else if ($_GET['error'] == "invalidnameinvalidemail") {
        $errorMsg = "Invalid name and email";

      }
      // (2) Invalid Name
      else if ($_GET['error'] == "invalidName") {
        $errorMsg = "Invalid name";
      }

      // () Invalid Email
      else if ($_GET['error'] == "invalidEmail") {
        $errorMsg = "Invalid email";

      }  else if ($_GET['error'] == "invalidPasswd") {
        $errorMsg = "Invalid password - you need to create a password with at least 1 capital letter, 1 number & 1 special character";
          // (4) Internal server error
      } else if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
        $errorMsg = "An internal server error - please try again later";
      // (5) User already exists
      }else if ($_GET['error'] == "usertaken") {
        $errorMsg = "Username already taken";

      }
      else if ($_GET['error'] == "nonuser") {
        $errorMsg = "User not found";
      }
      else if ($_GET['error'] == "errorInsertData") {
        $errorMsg = "Error inserting data";
      }
      // If we have error above  we display this
      echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';


      // Otherwise we display Success message
    } else if (isset($_GET['signup'])) {
      echo '<div class="alert alert-success" role="alert">You have successfully registerd !</div>';
    }


    ?>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="userName" value=<?php if (isset($_GET['userName'])) {
      echo $_GET['userName'];
      } ?>>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="userMail" >
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="userPassword" >
      </div>
      <button type="submit" name="submit" class="btn btn-dark">Submit</button>
    </form>
    <a class="m-auto mt-3" href="login_orders_form.php">have an account ?</a>
  </section>
  <!-- New Form: END -->




<?php require './templates/footer.php' ?>
