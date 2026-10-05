<?php

$okay = true;
$errors = "";

$firstName = trim($_POST['fname'] ?? "");
$lastName = trim($_POST['lname'] ?? "");
$email = trim($_POST['email'] ?? "");
$amount_raw = trim($_POST['amount'] ?? "");
$subscription = $_POST['subscription'] ?? 'no_subscription';

$safe_firstName = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');
$safe_lastName = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');
$safe_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

if (empty($firstName)) {
    $errors .= "Please add your First Name";
    $okay = false;
}
if (empty($lastName)) {
    $errors .= "Please add your Last Name";
    $okay = false;
}

if (empty($email)) {
    $errors .= "Email required";
    $okay = false;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors .= "This email is not valid. Please correct.";
    $okay = false;
}

if ($amount_raw === '') {
    $errors .= "Please insert a donation amount.";
    $okay = false;
} elseif (!is_numeric($amount_raw)) {
    $errors .= "Please use numbers only";
    $okay = false;
} elseif ($amount_raw <= 0) {
    $errors .= "Donation amount cannot be zero";
    $okay = false;
}

if ($okay) {

    $donation = number_format((float) $amount_raw, 2);

    $randomNumber = random_int(1000, 9999);
    $last_initial = strtoupper(substr($lastName, 0, 1));
    $length = strlen($lastName);
    $conf = $length . $last_initial . $randomNumber;

    $sub_message = "";
    switch ($subscription) {
        case 'no_subscription':
            $sub_message = "You have chosen not to subscribe to our e-magazine.";
            break;
        case 'subscription':
            $sub_message = "Congratulations on your free one year subscription to our e-magazine.";
            break;
    }

    if ($amount_raw >= 100) {
        $level = "Gold Supporter";
    } elseif ($amount_raw >= 50) {
        $level = "Silver Supporter";
    } elseif ($amount_raw >= 25) {
        $level = "Bronze Supporter";
    } else {
        $level = "Friend of the Animals";
    }

    $thankyou = "";
    for ($i = 1; $i <= 3; $i++) {
        $thankyou .= "Thank you! ";
    }

    $msg = "<p>Thank you $safe_firstName $safe_lastName for your donation of \$$donation.</p>";
    $msg .= "<p>Your confirmation number is $conf. We will email your receipt to $safe_email.</p>";
    $msg .= "<p>$sub_message</p>";
    $msg .= "<p>Your current donation level is: <strong>$level</strong>.</p>";
    $msg .= "<p>$thankyou</p>";

} else {

    $msg = "<p>Please <a href=\"donation2.html\">RETURN</a> and fill in the following errors in order to continue:</p>";
    $msg .= $errors;

}
?>

<head>
    <meta charset="utf-8">
    <title>Assignment 6 Control Structures</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 100%;
            background-image: url(https://cdn1.vectorstock.com/i/1000x1000/91/00/background-with-dog-paw-print-and-bone-vector-2669100.jpg);
            background-size: cover;
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

        .input_ck {
            display: inline;
            margin-bottom: 25px;
        }

        input[type=submit] {
            margin-top: 25px;
        }

        .red {
            color: red;
        }
    </style>

</head>

<body>
    <header>
        <h1>Humane Society Donations</h1>
        <h2>Help the Animals</h2>
    </header>

    <section id="outer">
        <h2 class="info">Donation Information</h2>
        <?php echo $msg; ?>
        <!-- Displayed the result message -->
    </section>


</body>

</html>