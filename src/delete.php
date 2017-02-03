<?php

require_once 'SqliteNoteRepository.php';
require_once 'Note.php';

$noteRepo = new \rbanjara\p3\SqliteNoteRepository();

?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])): ?>

<?php
//$noteRepo->deleteNote($_POST['id']);
$note = $noteRepo->getNoteById($_POST['id']);
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
    <h1>Are you sure you want to delete this note?</h1><br>
    <p>
    <form action="deleted.php" method="POST">
    <input type="hidden" name="id" value="<?php print $note->getId();?>">
    <input type="submit" value="YES" class="btn btn-danger">&nbsp; &nbsp; &nbsp; &nbsp;
    <a href="show.php?id=<?php print $note->getId();?>" class="a-delete">NO</a>
    </form>
    </body>
    </html>

    <?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Document</title>
    </head>
    <body>
      <h1>No Note Selected for deletion</h1>
      <p><a href="index.php">Back to Note List</a></p>
    </body>
    </html>
<?php endif; ?>




