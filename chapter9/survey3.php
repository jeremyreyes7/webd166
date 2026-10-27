<?php
// Chapter 9: PHP Sessions and a Multi-Page Form
// Name: Jeremy Reyes

session_start();

if (!isset($_SESSION['education'])) {
    header("Location: survey2.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $incomeRange = ['under $20,000', '$20,000 to $39,000', '$40,000 to $59,000', '$60,000 to $80,000', 'over $80,000'];
    $incomeInput = isset($_POST['income']) ? trim($_POST['income']) : '';

    if (in_array($incomeInput, $incomeRange)) {
        $_SESSION['income'] = $incomeInput;

        header("Location: survey_result.php");
        exit;
    } else {
        $error = "Please include a valid income level from the options shown.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anonymous Survey - Page 3</title>
    <link rel="stylesheet" href="survey.css">
</head>

<body>
    <div class="wrapper">

        <header>
            <h1>Anonymous Survey - Page 3</h1>

            <img class="survey-image"
                src="https://thewisconsinvegetablegardener.files.wordpress.com/2019/05/adm_survey_660x320.png?w=705"
                alt="Survey clipboard">
        </header>

        <main>
            <?php if (!empty($error)): ?>
                <p class="error" style="color: black; font-weight: bold; margin-bottom: 20px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="survey3.php" method="post">

                <fieldset>
                    <legend>What is your income bracket?</legend>

                    <div class="choice">
                        <input type="radio" id="under20" name="income" value="under $20,000">
                        <label for="under20">Under $20,000</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="income20-39" name="income" value="$20,000 to $39,000">
                        <label for="income20-39">$20,000 to $39,000</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="income40-59" name="income" value="$40,000 to $59,000">
                        <label for="income40-59">$40,000 to $59,000</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="income60-80" name="income" value="$60,000 to $80,000">
                        <label for="income60-80">$60,000 to $80,000</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="over80" name="income" value="over $80,000">
                        <label for="over80">Over $80,000</label>
                    </div>

                </fieldset>

                <button type="submit">Next &gt;&gt;</button>

            </form>
        </main>

    </div>
</body>

</html>