<?php

namespace rbanjara\p3;

require_once 'NoteRepository.php';
require_once 'Note.php';


class Notelist implements NoteRepository
{
    private $fileName = 'data/data.txt';

    public function saveNote($note)
    {
        $dataArray = $this->getAllNotes();
        $dataArray[$note->getId()] = $note;
        $serialData = serialize($dataArray);
        file_put_contents($this->fileName, $serialData);
    }

    public function getAllNotes()
    {
        $data = file_get_contents($this->fileName);
        if ($data) {
            $dataArray = unserialize($data);
            return $dataArray;
        } else {
            return array();
        }
    }

    public function getNoteById($id)
    {
        $noteList = $this->getAllNotes();
        if (array_key_exists($id, $noteList)) {
            return $noteList[$id];
        }
    }

    public function deleteNote($noteId)
    {
        $noteList = $this->getAllNotes();
        if (array_key_exists($noteId, $noteList)) {
            unset($noteList[$noteId]);
            $serialData = serialize($noteList);
            file_put_contents($this->fileName, $serialData);
        }
    }

}