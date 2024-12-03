<?php
// Function to handle division with exception handling for division by zero
function divide($numerator, $denominator) {
    if ($denominator == 0) {
        throw new Exception("Cannot divide by zero.");
    }
    return $numerator / $denominator;
}

// Function to check the date format with exception handling
function checkDateFormat($date, $format = 'Y-m-d') {
    $dateTime = DateTime::createFromFormat($format, $date);
    if (!$dateTime || $dateTime->format($format) != $date) {
        throw new Exception("Invalid date format.");
    }
    echo "The date $date is valid.<br>";
    return true;
}

// Testing Division
try {
    echo divide(10, 2) . "<br>"; // Should work
    echo divide(10, 0) . "<br>"; // Should throw exception
} catch (Exception $e) {
    echo "Division error: " . $e->getMessage() . "<br>";
}

// Testing Date Format
try {
    checkDateFormat("2023-03-10"); // Should work and confirm validity
    checkDateFormat("10/03/2023"); // Should throw exception
} catch (Exception $e) {
    echo "Date error: " . $e->getMessage() . "<br>";
}
?>
