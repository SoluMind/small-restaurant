<?php require './templates/header.php' ?>

<form action="includes/login_order.inc.php" method="POST">
  <div class="mb-3 w-50 m-auto">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="user_email" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 w-50 m-auto">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="user_password" id="exampleInputPassword1">
  </div>
  <button type="submit" name="login_action" class="btn btn-dark m-auto d-block w-25">Login</button>
</form>

<?php require './templates/footer.php' ?>
