<?php
// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "myDB");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regno = $_POST['regno'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    // Determine which action to take (Add, Update, Delete)
    switch ($_POST['action']) {
        case 'Add':
            $sql = "INSERT INTO student (regno, name, age, course) VALUES ('$regno', '$name', '$age', '$course')";
            break;

        case 'Update':
            $sql = "UPDATE student SET name='$name', age='$age', course='$course' WHERE regno='$regno'";
            break;

        case 'Delete':
            $sql = "DELETE FROM student WHERE regno='$regno'";
            break;

        default:
            $sql = "";
            break;
    }

    // Execute the query and check for errors
    if (!empty($sql) && $conn->query($sql) === FALSE) {
        echo "Error: $sql<br>" . $conn->error;
    }
}

// Function to display students
function displayStudents($conn) {
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Reg No</th><th>Name</th><th>Age</th><th>Course</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["regno"] . "</td><td>" . $row["name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["course"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Database Management</title>
</head>
<body>
    <h1>Manage Students</h1>
    <form method="post">
        Reg No: <input type="text" name="regno"><br><br>
        Name: <input type="text" name="name"><br><br>
        Age: <input type="number" name="age"><br><br>
        Course: <input type="text" name="course"><br><br>
        <input type="submit" name="action" value="Add">
        <input type="submit" name="action" value="Update">
        <input type="submit" name="action" value="Delete">
    </form>

    <?php
    // Display the student records
    displayStudents($conn);

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
 
