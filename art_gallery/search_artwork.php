<?php
session_start();
if (isset($_SESSION["art"])) {
    header("Location: main.php");
    exit();
    }

$host = "localhost";
$dbusername = "root";
$dbpassword = "Sak*23@g";
$dbname = "proj";

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $n=$_POST['artwork_id'];
    echo "<b><br>Entered Art ID is $n and the Corresponding table is shown Below <br><br></b>";
    
    $sql="select * from artwork where artwork_id='$n'";

                $result = $con->query($sql);

            if ($result->num_rows > 0) {
            echo "<table><tr><th>ArtID</th><th>Title</th><th>creation_date</th><th>price</th>";
                    while($row = $result->fetch_assoc()) {
               echo "<tr><td>" . $row["artwork_id"]. "</td><td>" . $row["title"]. "</td><td>" . $row["price"]."</td><td>" ;
            }
            echo "</table>";
        } else {
            echo "<p>Please Enter Correct Art ID</p>";
        }
        }

        $con->close();
?>


