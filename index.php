

<!-- HEADER.PHP -->
<?php require './templates/header.php' ?>

<main class="container mt-3">
  <?php
  if (isset($_SESSION['IdUsers'])) {
    echo '<div class="alert alert-success" role="alert">User Logged In Successfully  </div>
    <section id="featured" class="mb-5">
    <h2 class="text-center mb-4">Our Recipes</h2>
    <div class="row">';

    // Array of dishes
$dishes = [
    // First dish entry: An associative array containing id, name, and image
    [
        'id' => 1,  // Unique identifier for the dish
        'name' => ' Spaghetti',  // Name of the dish
        'image' => './menu/1.jpg'  // Path to the image representing the dish
    ],

    // Second dish entry: Another associative array for a different dish
    [
        'id' => 2,
        'name' => ' Beef ',
        'image' => './menu/7.jpg'
    ],

    // Third dish entry: Another associative array for a third dish
    [
        'id' => 3,
        'name' => ' Napolitana',
        'image' => './menu/6.jpg'
    ]
];

    foreach ($dishes as $dish) {
        echo '<div class="col-md-4 mb-3">
            <div class="card">
                <img src="' . $dish['image'] . '" class="card-img-top" alt="' . $dish['name'] . '">
                <div class="card-body">
                    <h5 class="card-title">' . $dish['name'] . '</h5>
                    <p class="card-text">Description of the dish and its ingredients.</p>
                     <form action="includes/order.inc.php" method="POST">
                        <input type="hidden" name="dish_id" value="' . $dish['id'] . '">
                        <a href="order_form.php?dish_id=' . $dish['id'] . '" class="btn btn-outline-dark">Order Now</a>
                    </form>
                </div>
            </div>
        </div>';
    }

    echo '</div>
    </section>';
  }

  else {
    echo '<div class="alert alert-warning" role="alert">You are not Registered</div>
    <section id="featured" class="mb-5">
    <h2 class="text-center mb-5 mt-5">Our Place View</h2>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="./image/outside.jpg" class="card-img-top" alt="Featured Dish 1">
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="./image/interrior-6.jpg" class="card-img-top" alt="Featured Dish 2">
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="./image/interrior-5.jpg" class="card-img-top" alt="Featured Dish 3">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</section>';
  }
  ?>





</main>



<!-- FOOTER.PHP -->
<?php
require './templates/footer.php';
?>

