<!DOCTYPE html>
<html>
<head>
    <title>Color Change by Day</title>
    <?php
    $daysOfWeek = array(
        'Sunday' => '#FF5733',
        'Monday' => '#33FF57',
        'Tuesday' => '#3357FF',
        'Wednesday' => '#FFFF33',
        'Thursday' => '#FF33FF',
        'Friday' => '#33FFFF',
        'Saturday' => '#FF3333'
    );
    $currentDay = date('l'); // Gets the full textual representation of the day
    $backgroundColor = '#FFFFFF'; // Default color
    if (array_key_exists($currentDay, $daysOfWeek)) {
        $backgroundColor = $daysOfWeek[$currentDay];
    }
    ?>
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
        }
    </style>
</head>
<body>
    <h1>Welcome! Today is <?php echo $currentDay; ?>.</h1>
</body>
</html>
