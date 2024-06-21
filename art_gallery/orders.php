<?php
session_start();
if (isset($_SESSION["art"])) {
    header("Location: main.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="orders.css">
    <script src="https://kit.fontawesome.com/9524c3e80f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Play:wght@700&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div id="header">
        <div id="mail">
            <a href="mailto:umazen103@gmail.com">
                <i class="fas fa-envelope"> umazen103@gmail.com</i>
            </a>
        </div>
        <div id="phone">
            <a href="tel:+9203481694445">
                <i class="fas fa-phone"> +920 3481 694 445</i>
            </a>
        </div>
        <div class="socials">
            <a href="https://www.facebook.com/umama.zainab.372?mibextid=ZbWKwL" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://instagram.com/umama__7?igshid=YmMyMTA2M2Y=" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
        </div>
    </div>

    <div id="navbar" class="h-nav">
        <div class="logo" id="logo1">
            <img src="logo.png" alt="loading logo">
        </div>
        <div>
            <ul class="nav-list v-class">
                <li><a href="main.html">Home</a></li>
                <li><a href="view_order.php">Order Details</a></li>
            </ul>
        </div>
    </div>
    <div id="background"></div>
    <div id="heading"></div>

    <div id="form">
        <h1>Please enter the following details:</h1>
        <form method="post" action="orders.php">
            <ul>
                <li><input type="text" class="form-control" id="cname" name="ord_date" placeholder="Date"></li>
                <li><input type="number" class="form-control" id="cname" name="quantity" placeholder="Quantity"></li>
                <li><input type="number" class="form-control" id="cname" name="total_price" placeholder="Total Price"></li>
                <li><input type="text" class="form-control" id="cname" name="shipping_address" placeholder="Shipping Address"></li>
                <li><input type="text" class="form-control" id="cname" name="shipping_status" placeholder="Shipping Status"></li>
                <li><input type="number" class="form-control" id="cname" name="artwork_id" placeholder="Artwork ID"></li>
                <li><input type="number" class="form-control" id="cname" name="users_id" placeholder="User ID"></li>
                <li id="button"><button type="submit">Insert</button></li>
            </ul>
        </form>
    </div>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ord_date = $_POST["ord_date"];
    $quantity = $_POST["quantity"];
    $total_price = $_POST["total_price"];
    $shipping_address = $_POST["shipping_address"];
    $shipping_status = $_POST["shipping_status"];
    $artwork_id = $_POST["artwork_id"];
    $users_id = $_POST["users_id"];
    
    // Connect to MySQL database
    require_once "config.php";
    
    // Call the stored procedure
    $sql = "CALL InsertOrder(?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sidsisi", $ord_date, $quantity, $total_price, $shipping_address, $shipping_status, $artwork_id, $users_id);
        
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
    
    // Close database connection
    $conn->close();
}
?>
</body>
</html>
