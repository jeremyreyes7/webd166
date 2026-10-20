<?php

$errors = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'age' => ''
];

$fname = '';
$lname = '';
$email = '';
$age_check = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fname = trim((string) ($_POST['fname'] ?? ''));
    $lname = trim((string) ($_POST['lname'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $age_check = isset($_POST['age']);

    $okay = true;

    if ($fname === '') {
        $errors['fname'] = 'Please enter your first name.';
        $okay = false;
    }
    if ($lname === '') {
        $errors['lname'] = 'Please enter your last name.';
        $okay = false;
    }
    if ($email === '') {
        $errors['email'] = 'Please enter your email address.';
        $okay = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
        $okay = false;
    }
    if (!isset($_POST['age'])) {
        $errors['age'] = 'You must confirm that you are over 18.';
        $okay = false;
    }
    if ($okay) {
        header('Location: subscribed.php');
        exit;
    }

}
require 'includes/header.php';
?>

<figure class="center">
    <img src="images/people.png" alt="People drinking coffee" width="300">
</figure>

<main id="content">

    <h2 class="center">Welcome to Coffee Connection!</h2>

    <p>
        We’re not just passionate lovers of coffee, but everything else that goes
        with a full and rewarding coffeehouse experience. We also offer a selection
        of premium teas, fine pastries, and other delectable treats. The music you
        hear in store is chosen for its artistry and appeal. It’s not unusual to see
        people coming to Coffee Connection to chat, meet up, or even work. We’re a
        neighborhood gathering place, a part of the daily routine, and would like
        to be part of your way of life.
    </p>

    <section id="contact">
        <h2 class="center">Sign Up to Receive Our Newsletter</h2>

        <form method="post" novalidate>
            <div class="flexcontainer">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="<?= htmlspecialchars($fname, ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <?php if (!empty($errors['fname'])): ?>
                <p class="red"><?= htmlspecialchars($errors['fname'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <div class="flexcontainer">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="<?= htmlspecialchars($lname, ENT_QUOTES, 'UTF-8') ?>">
            </div>


            <?php if (!empty($errors['lname'])): ?>
                <p class="red"><?= htmlspecialchars($errors['lname'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <div class="flexcontainer">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email"
                    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <?php if (!empty($errors['email'])): ?>
                <p class="red"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <div class="flexcontainer2">
                <label for="age">I am over 18:</label>
                <input type="checkbox" name="age" id="age" value="yes" <?= $age_check ? 'checked' : '' ?>>
            </div>

            <?php if (!empty($errors['age'])): ?>
                <p class="red"><?= htmlspecialchars($errors['age'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit">Submit</button>
                <a class="clear-link" href="coffeeconnection.php">Clear Form</a>
            </div>

        </form>
    </section>

    <section id="products">

        <div class="product center">
            <h3>Espresso</h3>
            <p><img src="images/coffee_espresso.jpg" alt="Espresso coffee"></p>
            <p>Popular espresso beverages — latte, americano, cappuccino, macchiato, and cold espresso drinks</p>
        </div>

        <div class="product center">
            <h3>Blended</h3>
            <p><img src="images/coffee_blended.jpg" alt="Blended coffee drinks"></p>
            <p>Delicious icy blends</p>
        </div>

        <div class="product center">
            <h3>Pastries</h3>
            <p><img src="images/coffee_pastries.jpg" alt="Pastries"></p>
            <p>Muffins, bagels, coffee cakes, and more</p>
        </div>

        <div class="product center">
            <h3>Food</h3>
            <p><img src="images/coffee_food.jpg" alt="Sandwiches, salads, and other food"></p>
            <p>Sandwiches, paninis, salads, and more</p>
        </div>

        <div class="product center">
            <h3>Breakfast</h3>
            <p><img src="images/coffee_breakfast.jpg" alt="Breakfast food"></p>
            <p>Biscuits, muffins, wraps, croissants, oatmeal, and more</p>
        </div>
    </section>
</main>

<?php require 'includes/footer.php'; ?>