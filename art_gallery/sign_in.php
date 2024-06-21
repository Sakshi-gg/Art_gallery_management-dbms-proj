<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["artwork"])) {
    header("Location: main.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to MySQL database
    require_once "config.php";

    // Call stored procedure to authenticate user
    $stmt = $conn->prepare("CALL login_user(?, ?)");

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            // Authentication successful
            $_SESSION["art"] = true; // Set session variable
            header("Location: main.php"); // Redirect to main page
            exit(); // Stop further execution of the script
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
            <a href="umazen103@gmail.com">
                <i class="fa-solid fa-envelope">umazen103@gmail.com</i>
            </a>
        </div>
        <div id="phone">
            <a href="tel:+920 3481 694 445">
                <i class="fa-solid fa-phone"> +920 3481 694 445</i>
            </a>
        </div>
        <div class="socials">
            <a href="https://www.facebook.com/umama.zainab.372?mibextid=ZbWKwL" target="_blank">
                <i class="fa-brands fa-1.5x fa-facebook-f"></i>
            </a>
            <a href="https://instagram.com/umama__7?igshid=YmMyMTA2M2Y=" target="_blank">
                <i class="fa-brands fa-1.5x fa-instagram"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank">
                <i class="fa-brands fa-1.5x fa-twitter"></i>
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
            </ul>
        </div>
    </div>
    
    <div id="background"></div>
    <div id="heading"></div>

    <div id="form">
        <h1>Please enter the following details:</h1>
        <form method="post" action="user.php">
            <ul>
                <li><input type="text" class="form-control" id="cname" name="username" placeholder="Username"></li>
                <li><input type="password" class="form-control" id="cname" name="password" placeholder="Password"></li>
               
                <li id="button">
    <button><a href="orders.php">Login</a></button><br><br>
</li>

    
                <h1 style="font-size=8" ><a href="user.php">click here,if not registered</a></h1>
            </ul>
        </form>
    </div>
</body>
</html>
