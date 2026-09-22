<?php

$milesDriven = $_POST["miles_driven"];
// Variable for miles driven 
$gallonsUsed = $_POST["gallons_used"];
// Variable for gallons used
$priceGallon = $_POST["price_gallon"];
// Variable for price of the gallon
$errorMessage = "";

if ($gallonsUsed > 0) {
    $mpg = $milesDriven / $gallonsUsed;
    // Activates only if gallons exceed 0, then factors mpg based on the data

    $CostOfTrip = $gallonsUsed * $priceGallon;
    // Displays cost of the trip based on price of gallons and the amount used
} else {
    $errorMessage = "Error: Gallons used must have a value higher than 0.";
    // Error message if the value is 0
}
?>

<!doctype html>
<!-- Jeremy Reyes -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trip Calculator Results</title>
</head>

<body>


    <h1>Trip Calculator Results</h1>

    <?php if (!empty($errorMessage)): ?>
        <p style="color: black; font-weight: bold;"><?php echo $errorMessage; ?></p>
    <?php else: ?>
        <h2>Values Entered</h2>
        <p><strong>Miles Driven: </strong><?php echo number_format($milesDriven) ?></p>
        <p><strong>Gallons Used: </strong><?php echo number_format($gallonsUsed) ?></p>
        <p><strong>Price Per Gallon: </strong><?php echo number_format($priceGallon) ?></p>

        <h2>Your Results</h2>
        <p><strong>Miles Driven:</strong> <?php echo number_format($milesDriven); ?></p>
        <p><strong>Gallons Used:</strong> <?php echo number_format($gallonsUsed, 2); ?></p>
        <p><strong>Price Per Gallon:</strong> <?php echo "$" . number_format($priceGallon, 2); ?></p>
        <p><strong>Miles Per Gallon (MPG):</strong> <?php echo number_format($mpg, 2); ?></p>
        <p><strong>Total Cost of Trip:</strong> <?php echo "$" . number_format($CostOfTrip, 2); ?></p>
    <?php endif; ?>

</body>

</html>