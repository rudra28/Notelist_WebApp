<?php

namespace rbanjara\p3;

class Note {
	private $id = '';
	private $subject = '';
	private $body = '';
    private $author = '';
    private $date = '';

	public function __construct(){
        //$this->id = uniqid();
    }

	/**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $rating
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $rating
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

}