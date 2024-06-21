<?php
session_start();
require_once "config.php";

// Redirect if user is already logged in
if (isset($_SESSION["art"])) {
    header("Location: main.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $artist_id = isset($_POST["artist_id"]) ? $_POST["artist_id"] : null;
    $artist_name = isset($_POST["artist_name"]) ? $_POST["artist_name"] : null;
    $style = isset($_POST["style"]) ? $_POST["style"] : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;
    $operation = isset($_POST["operation"]) ? $_POST["operation"] : null;

    // Prepare and execute stored procedure
    $stmt = $conn->prepare("CALL ManageArtist(?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $artist_id, $artist_name, $style, $address, $operation);
    
    if ($stmt->execute()) {
        if ($operation == "insert") {
            echo '<script>alert("New artist added successfully");</script>';
        } elseif ($operation == "update") {
            echo '<script>alert("Artist details updated successfully");</script>';
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Function to display artists
function displayArtists() {
    global $conn;
    $result = $conn->query("CALL ManageArtist(NULL, NULL, NULL, NULL, 'display')");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["artist_name"]."</td><td>".$row["style"]."</td><td>".$row["address"]."</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No artists found</td></tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Artists</title>
    <!-- Include CSS files here -->
</head>
<body>
    <h1>Manage Artists</h1>

    <div id="form">
        <h2>Add Artist</h2>
        <form method="post" action="manageart.php">
            <input type="hidden" name="operation" value="insert">
            <input type="text" name="artist_name" placeholder="Artist Name">
            <input type="text" name="style" placeholder="Style">
            <input type="text" name="address" placeholder="Address">
            <button type="submit">Insert</button>
        </form>
    </div>

    <div id="form">
        <h2>Update Artist</h2>
        <form method="post" action="manageart.php">
            <input type="hidden" name="operation" value="update">
            <input type="text" name="artist_id" placeholder="Artist ID">
            <input type="text" name="artist_name" placeholder="Artist Name">
            <input type="text" name="style" placeholder="Style">
            <input type="text" name="address" placeholder="Address">
            <button type="submit">Update</button>
        </form>
    </div>

    <div id="artists">
        <h2>Artists</h2>
        <table>
            <thead>
                <tr>
                    <th>Artist Name</th>
                    <th>Style</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php displayArtists(); ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
