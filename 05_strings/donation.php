<?php

$msg = '';

//The message variable

$firstName = trim($_POST['first_name'] ?? "");
$lastName = trim($_POST['last_name'] ?? "");
$email = trim($_POST['email'] ?? "");
$donationAmount = trim($_POST['donation'] ?? "");

$safe_firstName = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');
$safe_lastName = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');
$safe_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$safe_donationAmount = htmlspecialchars($donationAmount, ENT_QUOTES, 'UTF-8');

//Variable Names and the htmlspecialchars function to make text safer before displaying in HTML

$donation = $_POST['donation'] ?? 0;
$donation = number_format((float) $donation, 2);
// Formatted donation amount to 2 decimal places.

$randomNumber = random_int(1111, 9999);
$last_initial = strtoupper(substr($lastName, 0, 1));
$length = strlen($lastName);
$conf = $length . $last_initial . $randomNumber;
// Combine the values to create the confirmation number

$msg = "<p> Thank you $safe_firstName $safe_lastName for your donation of \$$donation.</p>";
$msg .= "<p> Your confirmation number is $conf. We will email your receipt to $safe_email.</p>";
//The confirmation message for the msg variable
?>

<!DOCTYPE html>
<!--Jeremy Reyes-->
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation Confirmation</title>

    <style>
        body {
            font-family: arial;
            font-size: 100%;
        }

        #outer {
            width: 960px;
            margin: 50px auto;
            padding: 10px;
            border: 1px solid #a8a8a8;
            box-shadow: 0px 0px 20px #a8a8a8;
            background-color: aliceblue;
        }

        h1,
        h2 {
            font-size: 1.5em;
            color: navy;
            text-align: center;
        }

        .info {
            text-align: left;
        }

        input {
            display: block;
            margin-bottom: 25px;
        }

        input[type=submit] {
            margin-top: 25px;
        }
    </style>

</head>

<body>
    <header>
        <h1>Humane Society Donations</h1>
        <h2>Help the Animals</h2>
    </header>

    <section id="outer">
        <h1 class="info">Your Contribution</h1>
        <?php echo $msg; ?>
        <!--displays the confirmation message with a randomly generated numbered invoice-->
    </section>

</body>

</html>