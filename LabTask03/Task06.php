<?php

$array = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];


$searchElement = 50;  


$found = 0;


for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == $searchElement) {
        $found = 1;
        break;  
    }
}


if ($found) {
    echo "$searchElement is found in the array.";
} else {
    echo "$searchElement is not found in the array.";
}
?>
