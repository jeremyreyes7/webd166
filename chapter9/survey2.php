<?php
// Chapter 9: PHP Sessions and a Multi-Page Form
// Name: Jeremy Reyes

session_start();

if (!isset($_SESSION['age'])) {
    header("Location: survey.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $educationLevel = ['High School', 'Associate Degree', "Bachelor's Degree", "Master's Degree", 'Doctoral Degree'];
    $educationInput = isset($_POST['education']) ? trim($_POST['education']) : '';

    if (in_array($educationInput, $educationLevel)) {
        $_SESSION['education'] = $educationInput;
        header("Location: survey3.php");
        exit;
    } else {
        $error = "Please input a valid education level from the list shown.";
    }
}
?>

<!doctype html>
<!-- Jeremy Reyes -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anonymous Survey - Page 2</title>
    <link rel="stylesheet" href="survey.css">
</head>

<body>
    <div class="wrapper">

        <header>
            <h1>Anonymous Survey - Page 2</h1>

            <img class="survey-image"
                src="https://thewisconsinvegetablegardener.files.wordpress.com/2019/05/adm_survey_660x320.png?w=705"
                alt="Survey clipboard">
        </header>

        <main>

            <?php if (!empty($error)): ?>
                <p class="error" style="color: #333; font-weight: bold; margin-bottom: 25px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="survey2.php" method="post">

                <fieldset>
                    <legend>What is your highest level of education?</legend>

                    <div class="choice">
                        <input type="radio" id="hs" name="education" value="High School">
                        <label for="hs">High School</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="associate" name="education" value="Associate Degree">
                        <label for="associate">Associate Degree</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="bachelors" name="education" value="Bachelor's Degree">
                        <label for="bachelors">Bachelor's Degree</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="masters" name="education" value="Master's Degree">
                        <label for="masters">Master's Degree</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="doctoral" name="education" value="Doctoral Degree">
                        <label for="doctoral">Doctoral Degree</label>
                    </div>

                </fieldset>

                <button type="submit">Next &gt;&gt;</button>

            </form>
        </main>

    </div>
</body>

</html>