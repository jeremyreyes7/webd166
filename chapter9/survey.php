<?php
// Chapter 9: PHP Sessions and a Multi-Page Form
// Name: Jeremy Reyes

session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ageRange = ['under 18', '18 - 29', '30 - 49', '50 - 65', 'over 65'];
    $ageInput = isset($_POST['age']) ? trim($_POST['age']) : '';

    if (in_array($ageInput, $ageRange)) {
        $_SESSION['age'] = $ageInput;
        header("Location: survey2.php");
        exit;
    } else {
        $error = "Please include your age range based on the available options.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anonymous Survey</title>
    <link rel="stylesheet" href="survey.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>Please Take Our Anonymous Survey</h1>
            <img class="survey-image"
                src="https://thewisconsinvegetablegardener.files.wordpress.com/2019/05/adm_survey_660x320.png?w=705"
                alt="class=" survey-image" ">
    </header>
<main>
                <?php if (!empty($error)): ?>
                            <p class=" error"
                    style="color: black; font-weight: bold; margin-bottom: 20px;"><?php echo $error; ?>
                </p>
            <?php endif; ?>

            <form action="survey.php" method="post">
                <fieldset>
                    <legend>What is your age group?</legend>
                    <div class="choice"><input type="radio" id="under18" name="age" value="under 18"><label
                            for="under18">Under 18</label></div>
                    <div class="choice"><input type="radio" id="age18-29" name="age" value="18 - 29"><label
                            for="age18-29">18 - 29</label></div>
                    <div class="choice"><input type="radio" id="age30-49" name="age" value="30 - 49"><label
                            for="age30-49">30 - 49</label></div>
                    <div class="choice"><input type="radio" id="age50-65" name="age" value="50 - 65"><label
                            for="age50-65">50 - 65</label></div>
                    <div class="choice"><input type="radio" id="over65" name="age" value="over 65"><label
                            for="over65">Over
                            65</label></div>
                </fieldset>
                <button type="submit">Next &gt;&gt;</button>
            </form>
            </main>
    </div>
</body>

</html>