<?php
class Message{
    private $titre;
    private $message;
    public function __construct($titre , $message)
    {
        $this->titre = $titre;
        $this->message = $message;
    }
}

?>
