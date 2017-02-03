<?php

require_once 'SqliteNoteRepository.php';
require_once 'Note.php';

$noteRepo = new \rbanjara\p3\SqliteNoteRepository();

//Shortend Get variable names if set
$noteId = isset($_GET['id']) ? $_GET['id'] : '';

$note = $noteRepo->getNoteById($noteId); 

?>

<?php if ($note): ?>
    
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Note <?php print $note->getSubject(); ?></title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body class="body-show">
<h2>Note Details</h2><br>
<div id="div-show">
<p>Note Id: <?php print $note->getId();?></p>
<p>Note Subject: <?php print htmlspecialchars($note->getSubject());?></p>
<p>Note Message: <?php print htmlspecialchars($note->getBody());?></p>
<p>Characters in note: <?php 
        $character = $note->getBody();
        $character = str_replace(" ", "", $character);
        $character = strlen($character);
print $character;?></p>
<p>Note Author: <?php print htmlspecialchars($note->getAuthor());?></p>
<p>Note Creation Date: <?php 

date_default_timezone_set('America/Chicago');
$date = date('l F j, Y');

print $date; ?></p>
</div><br>
<p>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php print $note->getId();?>">
        <input type="submit" value="Edit Note" class="btn btn-primary">
    </form>
</p>
<p>
    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?php print $note->getId();?>">
        <input type="submit" value="Delete Note" class="btn btn-danger">
    </form>
</p>

</body>
</html>

<?php else: ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>No Note To Show</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body class="body-show">
<h1>No Note Found</h1>
  <a href="index.php" class="a-show">Back to Note List</a>
</body>
</html>
<?php endif; ?>
