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
    <title>Artworks</title>
</head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Gallery Noir">
    <meta name="description" content="MDA Officers Colony Multan Official Website page">
    <title>Gallery Noir| Customers</title>
    <link rel="stylesheet" href="artwork.css">
    <script src="https://kit.fontawesome.com/9524c3e80f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Play:wght@700&family=Roboto+Condensed&display=swap"
        rel="stylesheet">
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
            <ul class=" nav-list v-class">
           < <li><a href="main.html">Home</li></a>
                
                <li><a href="work.php">Display_Artworks</li></a>
               
            </ul>
        </div>
    </div>
    <div id="background"></div>
    <div id="heading">
       
    </div>

    <div id="form">
        <h1>Please enter the following details: </h1>
        <form method="post" action="artwork.php" >
            <ul>
                <li><input type="text" class="form-control" id="cname" name="title" placeholder="Name"></li>
                
                <li><input type="text" class="form-control" id="cname" name="creation_date" placeholder="Date"></li>

                <li><input type="number" class="form-control" id="cname" name="price" placeholder="Price"></li>
               

                <li id="button"><button>Insert</button></a></li>
            </ul>
        </form>
    </div>
    <br>
    
<body>

<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $creation_date = isset($_POST["creation_date"]) ? $_POST["creation_date"] : null;
    $price = $_POST["price"];

    // Connect to MySQL database
    require_once "config.php";

    // Prepare and bind parameters
    $stmt = $conn->prepare("CALL InsertArtwork(?, ?, ?)");
    $stmt->bind_param("ssd", $title, $creation_date, $price);

    // Execute the stored procedure
    if ($stmt->execute()) {
        echo "New record created successfully<br>";
        echo '<script>window.location.href = "work.php";</script>';

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>


</body>
</html>
