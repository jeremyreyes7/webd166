<?php
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: contest.html');
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$photos = $_FILES['photos'] ?? null;
$errors = [];
$uploaded = false;
$storedFilename = [];
$maximumFilesAllowed = 3;
$uploadDirectory = __DIR__ . '/uploads/';
$maximumFileSize = 1048576;
$allowedMimeTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
];

function escapeHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if ($name === '') {
    $errors[] = 'Please enter your name here.';
}

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Please enter a valid email address.';
}

$imagesToLoad = [];

if (
    !is_array($photos)
    || !isset($photos['error'], $photos['size'], $photos['tmp_name'], $photos['name'])
    || !is_array($photos['error'])
) {
    $errors[] = 'You may upload up to 3 photos.';
} else {
    $fileNumber = count($photos['error']);
    if ($fileNumber === 0 || ($fileNumber === 1 && $photos['error'][0] === UPLOAD_ERR_NO_FILE)) {
        $errors[] = 'Please upload at least one photo to proceed.';
    } elseif ($fileNumber > $maximumFilesAllowed) {
        $errors[] = "A maximum of {$maximumFilesAllowed} photos are allowed in a single submission.";
    } else {
        $fileData = finfo_open(FILEINFO_MIME_TYPE);
        if ($fileData === false) {
            $errors[] = 'The photos were not uploaded. Please try again.';
        } else {
            for ($i = 0; $i < $fileNumber; $i++) {
                $photosNumber = $i + 1;
                $dataError = $photos['error'][$i];
                $tempName = $photos['tmp_name'][$i];
                $size = $photos['size'][$i];

                if ($dataError === UPLOAD_ERR_NO_FILE) {
                    $errors[] = "Photo #{$photosNumber} - An error has occurred. File not uploaded.";
                    continue;
                } elseif ($dataError === UPLOAD_ERR_FORM_SIZE || $dataError === UPLOAD_ERR_INI_SIZE) {
                    $errors[] = "Photo #{$photosNumber} exceeds the allowable size limit.";
                    continue;
                } elseif ($dataError !== UPLOAD_ERR_OK) {
                    $errors[] = "Photo #{$photosNumber} was not uploaded because (error {$dataError}).";
                    continue;
                }

                if ($size <= 0) {
                    $errors[] = "Photo #{$photosNumber} cannot be found.";
                    continue;
                } elseif ($size > $maximumFileSize) {
                    $errors[] = "Photo #{$photosNumber} cannot be above 1MB.";
                    continue;
                }

                if (!is_uploaded_file($tempName)) {
                    $errors[] = "Photo #{$photosNumber} could not be confirmed.";
                    continue;
                }

                $mimeType = finfo_file($fileData, $tempName);
                if ($mimeType === false || !isset($allowedMimeTypes[$mimeType])) {
                    $errors[] = "Photo #{$photosNumber} - Please note that only JPEG and PNG formats are allowed.";
                    continue;
                }

                $imagesToLoad[] = [
                    'tmp_name' => $tempName,
                    'extension' => $allowedMimeTypes[$mimeType],
                    'number' => $photosNumber,
                ];
            }
        }
    }
}

if (empty($errors) && !empty($imagesToLoad)) {
    if (!is_dir($uploadDirectory)) {
        $errors[] = 'Could not locate the upload directory';
    } elseif (!is_writable($uploadDirectory)) {
        $errors[] = 'It is note possible to write to this uploads directory.';
    } else {
        foreach ($imagesToLoad as $image) {
            $newFilename = bin2hex(random_bytes(16)) . '.' . $image['extension'];
            $destination = $uploadDirectory . $newFilename;

            if (move_uploaded_file($image['tmp_name'], $destination)) {
                $storedFilename[] = $newFilename;
            } else {
                $errors[] = "Photo #{$image['number']} could not be saved. Please try again.";
            }
        }

        if (!empty($storedFilename) && empty($errors)) {
            $uploaded = true;
        }
    }
}
?>

<!doctype html>
<!-- Jeremy Reyes -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Contest Results</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="wrapper">
        <header>
            <h1>Photo Contest</h1>
        </header>
        <main>
            <h2>Submission Results</h2>

            <?php if (!empty($errors)): ?>
                <h3>Please correct the following:</h3>
                <ul class="error">
                    <?php foreach ($errors as $error): ?>
                        <li><?= escapeHtml($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif ($uploaded): ?>
                <p class="message">Thank you, <?= escapeHtml($name) ?>, for entering our contest!</p>
                <p>Your photo was uploaded successfully.</p>
                <?php foreach ($storedFilename as $filename): ?>
                    <img class="photo-preview" src="uploads/<?= escapeHtml($filename) ?>"
                        alt="Photos submitted by <?= escapeHtml($name) ?>">
                <?php endforeach; ?>
            <?php else: ?>
                <p class="error">Your photograph has not been saved. Check it and try again.</p>
            <?php endif; ?>

            <p><a class="back-link" href="contest.html">Return to the Photo Contest form</a></p>
        </main>
    </div>
</body>

</html>