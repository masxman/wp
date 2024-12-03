<!DOCTYPE html>
<html>
<head>
    <title>Input Validation</title>
</head>
<body>
    <form method="post">
        Name: <input type="text" name="name"><br><br>
        Email: <input type="text" name="email"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Validate name
        if (empty($name)) {
            echo "Name is required.<br><br>";
        } else {
            echo "Name: $name<br><br>";
        }

        // Validate email
        if (empty($email)) {
            echo "Email is required.<br><br>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.<br><br>";
        } else {
            echo "Email: $email<br><br>";
        }
    }
    ?>
</body>
</html>