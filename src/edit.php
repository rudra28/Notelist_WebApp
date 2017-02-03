<?php

require_once 'Note.php';
require_once 'SqliteNoteRepository.php';

$noteRepo = new \rbanjara\p3\SqliteNoteRepository();

?>


<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])): ?>

    <?php
    // Came from show page based on id parameter
    $note = $noteRepo->getNoteById($_POST['id']);
     ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit Note</title>
            <link rel="stylesheet" type="text/css" href="stylesheet.css">
            <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        </head>
        <body class="body-edit">
        <h1>Edit Note</h1>
        <div class="div-edit">
        <form method="post" action="edit.php">
            <input type="hidden" name="noteId" value="<?php print $_POST['id']; ?>">
            <label>Note Subject: <input type="text" name="subject" value="<?php print htmlspecialchars($note->getSubject()); ?>"></label><br>
            <label>Note Body: <input type="text" name="body" rows="10" cols="30" value="<?php print htmlspecialchars($note->getBody()); ?>"></label><br>
            <label>Note Author: <input type="text" name="author" value="<?php print htmlspecialchars($note->getAuthor()); ?>"></label><br>
            <input type="submit" value="Save Note">
        </form>
        </div>
        </body>
        </html>

<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['noteId'])): ?>

    <?php
    // Process edit form
    //Shortend Post variable names if set
    $noteSubject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $noteBody = isset($_POST['body']) ? $_POST['body'] : '';
    $noteAuthor = isset($_POST['author']) ? trim($_POST['author']) : '';

    //Validate form fields
    $formIsValid = true;
    $subjectErr = '';
    $authorErr = '';
    if (empty($noteSubject)){
        $formIsValid = false;
        $subjectErr = '<span style="color: #f00;"> Subject is required!</span>';
    }
    if (empty($noteAuthor)){
        $formIsValid = false;
        $authorErr = '<span style="color: #f00;"> Author is required!</span>';
    }
    ?>
    <?php if ($formIsValid): ?>
        <?php
        //Process valid data and save song update
        $aNote = $noteRepo->getNoteById($_POST['noteId']);
        $aNote->setSubject($noteSubject);
        $aNote->setBody($noteBody);
        $aNote->setAuthor($noteAuthor);
        $noteRepo->saveNote($aNote);
        ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Note</title>
            <link rel="stylesheet" type="text/css" href="stylesheet.css">
            <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        </head>
        <body class="body-edit">
        <h1>Note Updated</h1><br>
        <p><a href="index.php" class="a-edit">Back to Note List</a></p>
        </body>
        </html>

    <?php else: ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Note</title>
            <link rel="stylesheet" type="text/css" href="stylesheet.css">
            <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        </head>
        <body class="body-edit">
        <h1>Edit Note</h1>
        <div class="div-edit">
        <form method="post" action="edit.php">
            <input type="hidden" name="noteId" value="<?php print $_POST['noteId']; ?>">
            <label>Note Subject: <input type="text" name="subject" value="<?php print $noteSubject; ?>"></label><?php print $subjectErr; ?><br>
           <label>Note Body: <br> <textarea name="body" rows="10" cols="30" value="<?php print $noteBody; ?>">Write your note here.</textarea></label>
            <br>
            <label>Note Author: <input type="text" name="author" value="<?php print $noteAuthor; ?>"></label><?php print $authorErr; ?>
            <br>
            <input type="submit" value="Save Note">
        </form>
        </div>
        </body>
        </html>
    <?php endif; ?>

<?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-edit">
      <h1>No Note Selected for Editing</h1><br><br>
      <p><a href="index.php" class="a-edit">Back to Note List</a></p>
    </body>
    </html>
<?php endif;?>