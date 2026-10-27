<?php
// Chapter 9: PHP Sessions and a Multi-Page Form
// Name: Jeremy Reyes

session_start();

if (!isset($_SESSION['income'])) {
        header("Location: survey.php");
        exit;
}
$ActualAgeInput = htmlspecialchars($_SESSION['age']);
$ActualEducationInput = htmlspecialchars($_SESSION['education']);
$ActualIncomeInput = htmlspecialchars($_SESSION['income']);

$successAnnouncement = "You have completed the survey! Thank you for your responses!";

session_unset();
session_destroy();
?>

<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Anonymous Survey Results</title>
        <link rel="stylesheet" href="survey.css">
</head>

<body>
        <div class="wrapper">
                <header>
                        <h1>Thank You for Taking Our Anonymous Survey</h1>

                        <img class="survey-image"
                                src="https://thewisconsinvegetablegardener.files.wordpress.com/2019/05/adm_survey_660x320.png?w=705"
                                alt="Survey clipboard">
                </header>

                <main>

                        <p class="successAnnouncement" style="color: #333; font-weight: bold; margin-bottom: 25px;">
                                <?php echo $successAnnouncement; ?>
                        </p>
                        <h2>Your Responses</h2>
                        <ul class="results">
                                <li><strong>Age:</strong> <?php echo $ActualAgeInput; ?> </li>
                                <li><strong>Education:</strong> <?php echo $ActualEducationInput; ?></li>
                                <li><strong>Income:</strong> <?php echo $ActualIncomeInput; ?></li>
                        </ul>
                        <p class="actions"><a class="button-link" href="survey.php">Take the Survey Again</a></p>
                </main>
        </div>
</body>

</html>