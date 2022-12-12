<?php
class Message{
    private $titre;
    private $message;
    private $date;
    public function __construct(string $titre ,string $message , ?DateTime $date=null)
    {
        $this->titre = $titre;
        $this->message = $message;
    }
    public function IsValid():bool{

        
    }
}

?>
