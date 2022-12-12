<?php
require_once './class/upload.php';
class Message{
    private $titre;
    private $message;
    private $date;

    public function __construct(string $titre ,string $message , ?DateTime $date=null)
    {
        $this->titre = $titre;
        $this->message = $message;
        $this->date = $date ?: new DateTime;
        
    }
    public function IsValid() : bool{
        return empty($this->geterror());
        
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
    public function getname() : string{
        $tab = file('./data/text');
        $der_ligne = $tab[count($tab)-1];
        //echo file_get_contents($der_ligne,FALSE,NULL,2,14);
        $tmp=explode('"', $der_ligne);
        return $tmp[13];
    }
    public function tohtml()
     {
        $path = $this->getname();
        $titre = htmlentities('image');
        $date=$this->date->format('D/M/Y a H:I');
        $messagee = htmlentities($this->message);
        if(!empty($_POST['image'])){
            return <<<HTML
            <div>
            <img src="./upload/{$path}" alt="new profil" width="200" height="200" >
            <p><strong>{$this->titre}</strong> <em>le {$date}</em><br> {$messagee}</p>
            </div>
            HTML;     
        }
        if(empty(isset($_POST['image']))) {
            $titre = htmlentities($this->titre);
            $date=$this->date->format('D/M/Y a H:I');
            $messagee = htmlentities($this->message);
                return <<<HTML
                <div>
                <img src="./nopicture/images.png" alt="new profil" width="200" height="200" >
                <p><strong>{$this->titre}</strong> <em>le {$date}</em><br> {$messagee}</p>
                </div>
                HTML;     
            
        }
    }
    public function affiche(): string  
    {
        $img = new upload('image');
        $imgg=$img->path();
        return json_encode([
            'titre' => $this->titre,
            'message' => $this->message,
            'date' => $this->date->getTimestamp(),
            "$imgg"
        ]);
    }
}

?>
