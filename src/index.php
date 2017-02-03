<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php", TRUE, 302);
    exit;
}
?>

<?php

require_once 'SqliteNoteRepository.php';
require_once 'Note.php';

$noteRepo = new \rbanjara\p3\SqliteNoteRepository();

$noteList = $noteRepo->getAllNotes();

date_default_timezone_set('America/Chicago');
$date = date('l F j, Y');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>NoteList</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body id="body-index"><center>
    <h2>Hello <?php echo $_SESSION['user'].'!'; ?></h2><br>
	<p><a href="create.php" id="anchor">Add New Note</a></p><br><br>
	
    <div id="index-div">
	<h1>NoteList </h1>
	<table class="table">
	<thead>
    <tr>
       <!-- 
        <th>Note</th>
        <th>Author</th> -->
        <th>Note ID</th>
        <th>Note Subject</th>
        <th>Characters in Note</th>
        <th>Note Creation/ Updation Date</th>
    </tr>
    </thead>
    <?php
    foreach($noteList as $note) {
    	$character = $note->getBody();
    	$character = str_replace(" ", "", $character);
    	$character = strlen($character);

        print '<tbody><tr class="success">';
        print '<th scope row="1" >' . $note->getId() . '</th>';
        print '<td><a href="show.php?id=' . $note->getId() . '" id="a-index">'. htmlspecialchars($note->getSubject()) .'</a></td>';
        //print '<td>' . $note->getBody() .'</td>';
        print '<td>' . $character .'</td>';
       // print '<td>'.$note->getAuthor() .'</td>';
        print '<td>'. $date .'</td>';
        print '</tr></tbody>';
    }
    ?>
</table>
</center>
</div>
<br><br>
<center><a href="login.php?logout" class="a-delete">Logout</a></center>
</body>
</html>