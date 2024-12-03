<!DOCTYPE html>
<html>
<head>
    <title>Cookie Handler</title>
</head>
<body>
    <?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set the cookie with a name and value from the form
        setcookie("username", $_POST['username'], time() + (10 * 30), "/"); // Cookie expires in 300 seconds (10*30)
        echo "<p>Cookie set. Reload the page to see the cookie value.</p>";
    }

    // Check if the cookie named "username" exists
    if (isset($_COOKIE["username"])) {
        echo "<p>Welcome back, " . htmlspecialchars($_COOKIE["username"]) . "!</p>";
    } else {
        echo "<p>Welcome, guest!</p>";
    }
    ?>

    <!-- HTML form to set a cookie -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Enter your name:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <input type="submit" value="Set Cookie">
    </form>
</body>
</html>
