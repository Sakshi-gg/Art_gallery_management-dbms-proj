<?php
session_start();
if (isset($_SESSION["art"])) {
    header("Location: main.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $artist_name = $_POST["artist_name"];
    $style = $_POST["style"];
    $address = $_POST["address"];

    // Connect to MySQL database
    require_once "config.php";

    // Prepare and bind parameters
    $stmt = $conn->prepare("CALL InsertArtist(?, ?, ?)");
    $stmt->bind_param("sss", $artist_name, $style, $address);

   
if ($stmt->execute()) {
    echo '<script>alert("New record created successfully");</script>';
    echo '<script>window.location.href = "art.php";</script>'; // Redirect to some_page.php after showing the popup
} else {
    echo "Error: " . $stmt->error;
}



    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Gallery Noir">
    <meta name="description" content="MDA Officers Colony Multan Official Website page">
    <title>Gallery Noir| Customers</title>
    <link rel="stylesheet" href="artworks_front.css">
    <script src="https://kit.fontawesome.com/9524c3e80f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Play:wght@700&family=Roboto+Condensed&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



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
                <li><a href="main.html">Home</a></li>
                <li><a href="art.php"> Display_Artists</a></li>
                <!-- <li><a href="artwork.php">Artworks</a></li>
                <li><a href="exhibition.php">Exhibition</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="orders.php">Orders</a></li> -->
            </ul>
        </div>
    </div>
    <div id="background"></div>
    <div id="heading">
        <!-- <h1>Gallery Noir</h1> -->
        <!-- <p id="p1">Welcome to our art gallery! We are dedicated to showcasing the work of talented artists
            from all over the
            world. Our mission is to provide a platform for artists to share their vision and inspire others through
            their creations
            Our gallery features a wide range of mediums, including painting, sculpture, photography, and more. We
            strive to bring together a diverse selection of art that reflects the creativity and diversity of the art
            world.
            We hope that you will take the time to explore our exhibitions and discover the beauty and inspiration that
            art has to offer. Thank you for visiting, and we hope to see you at our gallery soon!</p> -->
    </div>

    <div id="form">
        <h1>Please enter the following details: </h1>
        <form method="post" action="artist.php">
            <ul>
                <li><input type="text" name="artist_name" id="cname" placeholder="Enter the artist name"></li>

                <li><input type="text" name="style" id="cname" placeholder="Enter the type of art"></li>

                <li><input type="text" name="address" id="cname" placeholder="address"></li>


                <li id="button"><button type="submit">Insert</button></li>
            </ul>
        </form>
    </div>
    <br>
    <table class="table">
        <!-- <thead>
            <tr>
                <th class="heading">Artist name</th>

                <th class="heading">Type of Art</th>

                <th class="heading">Address</th>

            </tr>
        </thead> -->
    <body>
</body>

</html>
