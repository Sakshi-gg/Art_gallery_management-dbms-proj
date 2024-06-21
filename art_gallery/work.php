<?php
session_start();
if (isset($_SESSION["art"])) {
    header("Location: main.php");
    exit();
}

require_once "config.php";

// Call the stored procedure to display artist details
$stmt = $conn->prepare("CALL DisplayArtworks()");
$stmt->execute();
$result = $stmt->get_result();

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Gallery Noir">
    <meta name="description" content="MDA Officers Colony Multan Official Website page">
    <title>Gallery Noir</title>
    <link rel="stylesheet" href="art.css">
    <script src="https://kit.fontawesome.com/9524c3e80f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Play:wght@700&family=Roboto+Condensed&display=swap"
        rel="stylesheet">
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
                <li><a href="artwork.php">Add Artworks</a></li>
                <li><a href="update_artwork.php">Update Artwork</a></li>
                <li><a href="delete_artwork.php">Delete Artwork</a></li>


            </ul>
        </div>
    </div>
    
    <div class="background">
        <div id="heading">
            <h2 class="det">Artwork Details</h2>
          
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>Artwork_id</th>
                            <th>Art_name</th>
                            <th>Date</th>
                            <th>Price</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display artist details fetched from the database
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["artwork_id"] . "</td>";   
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["creation_date"] . "</td>";
                        echo "<td>$" . $row["price"] . "</td>";
                        echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
