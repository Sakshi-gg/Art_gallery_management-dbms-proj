<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    <link rel="stylesheet" href="artworks_front.css">
    <title>Registration Form</title>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            

            $errors = array();

            if (empty($username) || empty($first_name) || empty($last_name) || empty($email) || empty($password) ) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }

            if (count($errors) === 0) {
                require_once "config.php";
                $stmt = mysqli_prepare($conn, "CALL register_user(?, ?, ?, ?, ?)");

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $first_name, $last_name, $email, $password);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $message);

                    // Check if any result is returned
                    if (mysqli_stmt_fetch($stmt)) {
                        echo "<div class='alert alert-success'>$message</div>";
                    } else {
                        array_push($errors, "Error: " . mysqli_error($conn));
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    array_push($errors, "Error: " . mysqli_error($conn));
                }
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
        }
        ?>

<form method="post" action="reg.php">
            <ul>
                <li><input type="text" name="username" id="cname" placeholder="name"></li>

                <li><input type="text" name="first_name" id="customer_id" placeholder="fname"></li>

                <li><input type="text" name="last_name" id="address" placeholder="lname"></li>
                <li><input type="email" name="email" id="address" placeholder="email"></li>
                <li><input type="password" name="password" id="address" placeholder="password"></li>


                <li id="button"><button type="submit" name="submit">Insert</button></li>
            </ul>
        </form>

        <div>
            <div><p>Already Registered <a href="log.php">Login Here</a></p></div>
        </div>
    </div>
</body>
</html>
