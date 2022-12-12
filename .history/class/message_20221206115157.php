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
    public function IsValid() : bool{
        return empty($this->geterror());
        
    }
    public function geterror(){
        $error = [];
        if(strlen($this->titre) < 5){
            $error['titre']='Votre titre est trop courte'];
        }
        if(strlen($this->message) > 300){
            $error['message']='votre message est assez long';
        }
    }
}

?>
