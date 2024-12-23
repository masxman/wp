<!DOCTYPE html>
<html>
<head>
    <title>File Reader and Writer</title>
</head>
<body>
    <form action="FileReadWrite.php" method="post">
        <label for="textdata">Enter Text:</label><br>
        <textarea name="textdata" id="textdata"></textarea><br>
        <input type="submit" value="Write to File"><br><br>
    </form>
    <form action="FileReadWrite.php" method="post" enctype="multipart/form-data">
        <label for="filedata">Upload File to Read File Contents:</label><br>
        <input type="file" name="filedata" id="filedata"><br>
        <input type="submit" value="Read File Contents"><br><br>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['textdata'])) {
        file_put_contents("output.txt", $_POST['textdata']);
        echo "Data written to file.<br>";
    }

    if (!empty($_FILES['filedata']['tmp_name'])) {
        $fileContent = file_get_contents($_FILES['filedata']['tmp_name']);
        echo "File content: " . htmlspecialchars($fileContent) . "<br>";
    }
}
?>
