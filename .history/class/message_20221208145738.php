<?php
require_once './index.php'; 

class Message{
    private $titre;
    private $message;
    private $date;
    private $pathh;

    public function __construct(string $titre ,string $message , ?DateTime $date=null)
    {
        $this->titre = $titre;
        $this->message = $message;
        $this->date = $date ?: new DateTime;
        
    }
    public function IsValid() : bool{
        return empty($this->geterror());
        
    }
    public function picuture(string $img): string 
    {

    }
    public function geterror(){
        $error = [];
        if(strlen($this->titre) < 5){
            $error['titre']='Votre titre est trop courte';
        }
        if(strlen($this->message) > 300 || strlen($this->message) < 10){
            $error['message']='votre message est assez long';
        }
        return $error;
    }
    public function tohtml(): string
     {
         $titre = htmlentities($this->titre);
         $date=$this->date->format('D/M/Y a H:I');
         $messagee = htmlentities($this->message);
        return <<<HTML
        <div >
        <img src="" alt="new profil" width="200" height="200" >
        <p><strong>{$this->titre}</strong> <em>le {$date}</em><br> {$messagee}</p>
        </div>
        HTML;
                  
    }
    public function affiche(): string  
    {
        return json_encode([
            'titre' => $this->titre,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
}

?>
