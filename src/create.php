<?php
require_once 'Note.php';
require_once 'SqliteNoteRepository.php';

//Shortend Post variable names if set
// $noteId = isset($_POST['id']);
$noteSubject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$noteBody = isset($_POST['body']) ? $_POST['body'] : '';
$noteAuthor = isset($_POST['author']) ? trim($_POST['author']) : '';

//Validate form fields
$formIsValid = true;
$subjectErr = '';
$authorErr = '';
if (empty($noteSubject)){
    $formIsValid = false;
    $subjectErr = '<span style="color: #943126;"> Subject is required!</span>';
}
if (empty($noteAuthor)){
    $formIsValid = false;
    $authorErr = '<span style="color: #943126;"> Author is required!</span>';
}

?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <?php if ($formIsValid): ?>
            <?php
            $noteRepo = new \rbanjara\p3\SqliteNoteRepository();
            $note = new \rbanjara\p3\Note();
            // $note->setId($noteId);
            $note->setSubject($noteSubject);
            $note->setBody($noteBody);
            $note->setAuthor($noteAuthor);
            $noteRepo->saveNote($note);
            ?>
            
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Add a new note</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-create">
            <h1>New Note Created</h1><br>
            <div class="div-create">
           <!--  <p>Note Id: <?php print $note->getId(); ?> </p> -->
            <p>Note Subject: <?php print htmlspecialchars($noteSubject); ?></p>
            <p>Note Message: <?php print htmlspecialchars($noteBody); ?></p>
            <p>Characters in Note: <?php 
             $character = $note->getBody();
             $character = str_replace(" ", "", $character);
             $character = strlen($character);
            print $character; ?> </p>
            <p>Note Author: <?php print htmlspecialchars($noteAuthor); ?></p>
            <p>Note Creation Date: <?php 
            date_default_timezone_set('America/Chicago');
            $date = date('l F j, Y'); 

            print $date; ?></p>
            </div>
            <br>
            <p><a href="index.php" id="a-create">Show All Notes</a></p>
    </body>
    </html>

        <?php else: ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Create New Note</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-create">        
            <h1>Create New Note</h1>
            <div class="div-create">
            <form method="post" action="create.php">
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

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Create New Note</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body class="body-create">        
    <h1>Create New Note</h1>
    <div class="div-create">
        <form method="post" action="create.php">
            <label>Subject: <input type="text" name="subject"></label><br>
            <label>Note:<br><br> <textarea name="body" rows="10" cols="30">Write your note here.</textarea></label> 
            <br>
            <label>Author: <input type="text" name="author"></label><br>
            <input type="submit" value="Save Note">
        </form>
    </div>
    <?php endif; ?>
</body>
</html>