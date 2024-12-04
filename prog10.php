<?php
function removeDuplicates($array) {
    $result = array_values(array_unique($array));
    return $result;
}

$sortedList = [1, 1, 2, 2, 3, 3, 4, 5, 5];
$uniqueList = removeDuplicates($sortedList);

echo "Original List: <br><pre>";
print_r($sortedList);
echo "</pre>";

echo "Unique List: <br><pre>";
print_r($uniqueList);
echo "</pre>";
?>
