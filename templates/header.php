<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap 5.0 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- External CSS -->
  <link rel="stylesheet" href="../css/styles.css">
  <title>UserLogin</title>
</head>

<body class="flex-column w-100">
  <!-- Header: START -->
  <header class="container">

    <div id="logo" class="text-justfiy-content-left">
    <h2><span>Logo</span></h2>
    </div>


    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>



      <!-- Then we dynimically display them  using the id user or IdUsers -->
      <?php
      if (isset($_SESSION['IdUsers'])) {
      // This code checks if a user is logged in by verifying the session variable 'IdUsers'.
      // If the user is logged in, it displays the "Create Post" link and a Logout button.
      // If the user is not logged in, it shows the "Signup" link and a Login button that triggers a modal.
        echo '<li class="nav-item">
        <a class="nav-link" href="createpost.php">Create Post</a>
      </li>';

      } else {
        echo '<li class="nav-item">
        <a class="nav-link active" href="signup.php">Signup</a>
      </li>

     ';
      }

      ?>

      <?php
      if (isset($_SESSION['IdUsers'])) {
        echo '<li class="nav-item">
        <form action="./includes/logout.inc.php">
          <button type="submit" class="btn btn-warning w-100" name="logged-submit">Logout</button>
        </form>
      </li>';
      } else {
        // <!-- 2. Logged our users this navlink we have to display  -->
        echo '<li class="nav-item">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-modal">
          Login
        </button>
      </li>';
      }
      ?>

    </ul>
    <!-- <h1>Table Users</h1> -->
  </header>
  <!-- Header: END -->
  <section class="container mt-3">


    <?php

    // Check $_GET to see if we have any login error messages
    $errorMsg = "";

    if(isset($_GET['loginerror'])) {
      // (i) Empty fields in Login
        if ($_GET['loginerror'] == "emptyfields") {
            $errorMsg="Please fill in all fields";

            // (ii) 500 ERROR: SQL Error
          }
          if($_GET['loginerror'] == "sqlerror") {
            $errorMsg="Internal server error - please try again later";

            // (iii) uidUsers / emailUsers do not match
          }
          if($_GET['loginerror']=="nonuser") {
            $errorMsg = "The user does not exist, please try again";
            // $errorMsg = "Incorrect credentials";

            // (iv) Password does NOT match DB
          }
          if($_GET['loginerror']=="wronguserpwd") {
            $errorMsg="Wrong password";
            // $errorMsg = "Incorrect credentials";

            // (iii) loginerror=forbidden
          }
          if($_GET['loginerror']=="forbidden") {
            $errorMsg="Please submit form correctly";
          }
            // ERROR CATCH-ALL: Display alert with dynamic error message
          if($errorMsg !== " ") {
            echo '<div class="alert alert-danger" role="alert">' .$errorMsg. '</div>';
          }



    }
    if(isset($_GET['login']) == "success") {
      // SUCCESS: User login successful message
      echo '<div class="alert alert-primary" role="alert">Welcome ' . $_SESSION['uidUsers'] . '</div>';
    }
    ?>


  </section>
  <!-- Error Message from GET: END -->

  <!-- Login Modal: START -->
  <div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>

        <!-- login.inc.php - Will process the data from this form-->
        <div class="modal-body">
          <!-- LOGIN FORM: START -->
          <form action="includes/login.inc.php" method="POST">
            <div class="mb-3">
              <label for="email" class="col-form-label">Email address:</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="mailuid" placeholder="Email Address">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="mb-3">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" class="form-control" id="password" name="pwd" placeholder="Password"></input>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary w-100" name="login-submit">Login</button>
            </div>
          </form>
          <!-- LOGIN FORM: END -->
        </div>
      </div>
    </div>
  </div>
  <!-- Login Modal: END -->




