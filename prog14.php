{ Note – you have to change the [image_data in to LOGBLOB] , open file explorer path as [C:\xampp\mysql\bin] and find “my.ini” open file scroll down and find “mysqld” , add max_allowed_packet=64M
wait_timeout=28800
interactive_timeout=28800 , save it then go to xmapp and restart the mysql then run the program }
<?php
session_start();

if (!function_exists('reconnect')) {
    function reconnect($conn) {
        if (!$conn->ping()) {
            $conn->close();
            $conn = new mysqli("localhost", "root", "", "myDB");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        return $conn;
    }
}

$conn = new mysqli("localhost", "root", "", "myDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    // Display Image
    $id = intval($_GET['id']);
    $conn = reconnect($conn);
    $stmt = $conn->prepare("SELECT image_type, image_data FROM images WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imageType, $imageData);
    $stmt->fetch();
    header("Content-Type: " . $imageType);
    echo $imageData;
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // Upload Image
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
    $imageName = $_FILES["image"]["name"];
    $imageType = $_FILES["image"]["type"];

    $conn = reconnect($conn);
    $stmt = $conn->prepare("INSERT INTO images (image_name, image_type, image_data) VALUES (?, ?, ?)");
    $null = NULL;
    $stmt->bind_param("ssb", $imageName, $imageType, $null);
    $stmt->send_long_data(2, $imageData);
    $stmt->execute();
}

function displayImages($conn) {
    // Display Uploaded Images
    $sql = "SELECT id, image_name FROM images";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<img src='?id=" . $row["id"] . "' alt='" . $row["image_name"] . "'><br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload and Display</title>
</head>
<body>
    <h1>Upload and Display Images</h1>
    <form method="post" enctype="multipart/form-data">
        Select image to upload: <input type="file" name="image" id="image">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <h2>Uploaded Images:</h2>
    <?php displayImages($conn); ?>
    <?php $conn->close(); ?>
</body>
</html>
