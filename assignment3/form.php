<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$heard = $_POST['heard'];
$comments = $_POST['comments'];
$heading = "Form Results";
?>

<!DOCTYPE html>
<html lang="en">
<!-- Jeremy Reyes -->

<head>
    <meta charset="utf-8">
    <title>Account Sign Up</title>
    <link rel="stylesheet" href="form.css">
</head>
<main>

    <body>
        <header>
            <h1><?= $heading ?></h1>
        </header>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <!-- Retrieve the name entered in the form.
    $name = $_POST['name']; -->


        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <!--Retrieve the email entered in the form.
    $email= $_POST['email']; -->

        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        <!-- Retrieve the Phone entered in the form.
    $phone= $_POST['phone']; -->

        <p><strong>How did you hear about us?:</strong> <?php echo $heard; ?></p>
        <!-- Retrieve the heard from section entered in the form.
    $heard= $_POST['heard']; -->

        <p><strong>Comments:</strong> <?php echo $comments; ?></p>
        <!--Retrieve the comments entered in the form.
    $comments= $_POST['comments']; -->
    </body>
</main>

</html>