<?php

$amount = 1000;  


$vatRate = 0.15;


$vatAmount = $amount * $vatRate;


$totalAmount = $amount + $vatAmount;


echo "Original Amount: $amount<br>";
echo "VAT (15%): $vatAmount<br>";
echo "Total Amount (Including VAT): $totalAmount<br>";
?>
