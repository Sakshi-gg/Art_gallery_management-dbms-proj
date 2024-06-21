<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION["art"])) {
    header("Location: main.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = isset($_POST["username"]) ? $_POST["username"] : null;
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : null;
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    // Validate form data
    if (empty($username) || empty($password) || empty($first_name)) {
        $error = "Username, password, and first name are required.";
    } else {
        // Connect to MySQL database
        require_once "config.php";

        // Call stored procedure to insert user data
        $stmt = $conn->prepare("CALL insert_user(?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sssss", $username, $first_name, $last_name, $email, $password);

            if ($stmt->execute()) {
                $success = "New record created successfully";
            } else {
                $error = "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            $error = "Error: " . $conn->error;
        }

        // Close database connection
        $conn->close();
    }
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

<div id="navbar" class="h-nav">
        <div class="logo" id="logo1">
            <img src="logo.png" alt="loading logo">
        </div>
        <div>
            <ul class=" nav-list v-class">
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
                <li><input type="text" class="form-control" id="cname" name="first_name" placeholder="First Name"></li>
                <li><input type="text" class="form-control" id="cname" name="last_name" placeholder="Last Name"></li>
                <li><input type="email" class="form-control" id="cname" name="email" placeholder="Email"></li>
                <li><input type="password" class="form-control" id="cname" name="password" placeholder="Password"></li>
                <li id="button"><button>Register</button></li><br><br>

                <h1 style="font-size=8"><a href="sign_in.php">click here,if already registered</a></h1>
            </ul>
        </form>
    </div>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
</body>
</html>
