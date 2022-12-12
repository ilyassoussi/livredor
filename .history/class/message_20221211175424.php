<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
      .testi {
        display: inline-block;
        width: 600px;
        height: 100px;
        color: black;
    }
  </style>
</head>
<body>
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
    public function getname(){
        $tab = file('./data/text');
        $der_ligne = $tab[count($tab)-1];
        //echo file_get_contents($der_ligne,FALSE,NULL,2,14);
        $tmp=explode('"', $der_ligne);
        if ($tmp[13] != "") {
            return './upload/'.$tmp[13];
        }if($tmp[13] == ""){
            return "./nopicture/images.png";
        }
    }
    public function tohtml()
     {
        $path = $this->getname();
        $titre = htmlentities('image');
        $date=$this->date->format('D/M/Y a H:I');
        $messagee = htmlentities($this->message);
            return <<<HTML
                <div class="testi">
                    <div>
                    <img src="{$path}" alt="new profil" width="200" height="200" >
                    <p><strong>{$this->titre}</strong> <em>le {$date}</em><br> {$messagee}</p>
                    </div>
                </div>
            HTML;     
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

 </body>
</html>