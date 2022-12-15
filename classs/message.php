<!DOCTYPE html>
<html>
<head>
  <style>
      .testi {
        display: inline-block;
        width: 400px;
        height: 150px;
        color: black;   
        padding: 35px;
    }
  </style>
  <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
</script>
</head>
<body>
<?php
require_once './classs/upload.php';
class Message{
    private $titre;
    private $message;
    private $date;
    private $image;

    public function __construct(string $titre ,string $message , ?DateTime $date=null,?String $image=null )
    {
        $this->titre = $titre;
        $this->message = $message;
        $this->date = $date ?: new DateTime;
        $this->image = $image ?: new upload('image');
    }
    public function IsValid() : bool{
        return empty($this->geterror());
        
    }
    public function geterror(){
        $error = [];
        if(strlen($this->titre) > 60){
            $error['titre']='Votre titre est assez long';
        }
        elseif(strlen($this->titre) < 5){
            $error['titre']='Votre titre est trop courte';
        }
        if(strlen($this->message) >= 300){
            $error['message']='votre message est assez long';
        }elseif(strlen($this->message) < 10){
            $error['message']='votre message est trop courte';
        }
        return $error;
    }
        public function tohtml()
     {
        //$this->image = $this->getname();
        $titre = htmlentities($this->titre);
        $date=$this->date->format('D/M/Y a H:I');
        $messagee = nl2br(htmlentities($this->message));//nl2br pour le return a la ligne
            return <<<HTML
                <div class="testi" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <img src="{$this->image}" alt="" width="200" height="200" >
                    <p><strong>{$titre}</strong><br> <em>le {$date}</em><br> {$messagee}</p>                  
                </div>
            HTML;     
    }
    public function affiche(): string  
    {
        $this->image= new upload('image');
        $this->image=$this->image->path();
        return json_encode([
            'titre' => $this->titre,
            'message' => $this->message,
            'image'=>"$this->image",
            'date' => $this->date->getTimestamp()          
        ]);
    }
}

?>

 </body>
</html>
