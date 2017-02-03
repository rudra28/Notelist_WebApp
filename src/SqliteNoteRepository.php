<?php

namespace rbanjara\p3;

require_once 'NoteRepository.php';
require_once 'Note.php';


class SqliteNoteRepository implements NoteRepository
{
    private $database;
    private $fileName = 'data/data.sqlite';

    public function __construct(){
        //open the database
        $this->database = new \PDO('sqlite:' . $this->fileName);

        //create the table if not exists
        $this->database->exec("CREATE TABLE IF NOT EXISTS Notes (Id INTEGER PRIMARY KEY, Subject TEXT, Message TEXT, Author TEXT)");
    }

    public function saveNote($note)
    {
        if ($note->getId() != '') {
            //Update
            $stmh = $this->database->prepare("UPDATE Notes SET Subject = :subject, Message = :message, Author = :author WHERE id = :id");
            $aSubject = $note->getSubject();
            $aBody = $note->getBody();

            // $character = $note->getBody();
            // $character = str_replace(" ", "", $character);
            // $character = strlen($character);

            $aAuthor = $note->getAuthor();

            // date_default_timezone_set('America/Chicago');
            // $create = date('l F j, Y');

            $aId = $note->getId();

            $stmh->bindParam(':subject', $aSubject);
            $stmh->bindParam(':message', $aBody);
            //$stmh->bindParam(':character', $character);
            $stmh->bindParam(':author', $aAuthor);
            //$stmh->bindParam(':created', $create);
            $stmh->bindParam(':id', $aId);
            return $stmh->execute();
        } else {
            //Insert
            $stmh = $this->database->prepare("insert into Notes (Subject, Message, Author) values (:subject, :message, :author)");

            $aSubject = $note->getSubject();
            $aBody = $note->getBody();

            // $character = $note->getBody();
            // $character = str_replace(" ", "", $character);
            // $character = strlen($character);

            $aAuthor = $note->getAuthor();

            // date_default_timezone_set('America/Chicago');
            // $create = date('l F j, Y');

            $stmh->bindParam(':subject', $aSubject);
            $stmh->bindParam(':message', $aBody);
            //$stmh->bindParam(':character', $character);
            $stmh->bindParam(':author', $aAuthor);
            //$stmh->bindParam(':created', $create);
            return $stmh->execute();
        }
    }

    public function getAllNotes()
    {
        $notelist = array();
        $result = $this->database->query('SELECT * FROM Notes');
        foreach($result as $row) {
            $aNote = new Note();
            $aNote->setSubject($row['Subject']);
            $aNote->setBody($row['Message']);
            $aNote->setAuthor($row['Author']);
            $aNote->setId($row['Id']);
            $notelist[$aNote->getId()] = $aNote;
        }
        return $notelist;
    }

    public function getNoteById($id)
    {
        $stmh = $this->database->prepare("SELECT * from Notes WHERE Id = :id");
        $sid = intval($id);
        $stmh->bindParam(':id', $sid);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);

        if ($row = $stmh->fetch()) {
            $aNote = new Note();
            $aNote->setId($row['Id']);
            $aNote->setSubject($row['Subject']);
            $aNote->setBody($row['Message']);
            $aNote->setAuthor($row['Author']);
            return $aNote;
        } else {
            return new Note();
        }
    }

    public function deleteNote($noteId)
    {
        $stmh = $this->database->prepare("DELETE FROM Notes WHERE id = :id");
        $stmh->bindParam(':id', intval($noteId));
        return $stmh->execute();
    }

}