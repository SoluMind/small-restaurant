<?php  './templates/header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <style>
     body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
  </style>
    <div class="success-message">
        <h1>Thank you for your order!</h1>
        <p>Your order has been successfully placed. We'll process it as soon as possible.</p>
        <p><button onclick="window.location.href='index.php'">Return to Home</button></p>
    </div>

</body>
</html>
<?php  './templates/footer.php';?>

