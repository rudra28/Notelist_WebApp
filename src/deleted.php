<?php

require_once 'Note.php';
require_once 'SqliteNoteRepository.php';

$noteRepo = new rbanjara\p3\SqliteNoteRepository();

?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])): ?>

    <?php
    $noteRepo->deleteNote($_POST['id']);
    ?>

    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Delete Note</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-delete">
    <h1>Note Deleted</h1>
    <p><a href="index.php" class="a-delete">Back to Note List</a></p>
    </body>
    </html>

<?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-delete">
    <h1>No Note Selected for deletion</h1><br><br>
    <p><a href="index.php" class="a-delete">Back to Note List</a></p>
    </body>
    </html>
<?php endif; ?>


<!-- <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Note</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-delete">
    <h1>Note Deleted</h1><br><br>
    <p><a href="index.php" class="a-delete">Back to Note List</a></p>
    </body>
    </html> -->