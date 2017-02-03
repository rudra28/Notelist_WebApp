<?php

namespace rbanjara\p3;


interface NoteRepository
{
    public function saveNote($note);
    public function getAllNotes();
    public function getNoteById($id);
    public function deleteNote($noteId);
}