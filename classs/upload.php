<?php

class upload {
    private $file;

    public function __construct(string $image)
    {
        $this->file = $image;
        if(!empty($_FILES[$this->file])){
            $nameFile = $_FILES[$this->file]['name'];
            $typeFile = $_FILES[$this->file]['type'];
            $sizeFile = $_FILES[$this->file]['size'];
            $tmpFile = $_FILES[$this->file]['tmp_name'];
            $errFile = $_FILES[$this->file]['error'];
        $extensions = ['png', 'docx', 'jpeg', 'doc'];
		// Type d'image 
		$type = ['image/png',  'image/jpeg'];
		// On récupère
		$extension = explode('.', $nameFile);
		// Max size
		$max_size = 1000000;
		
		// On vérifie que le type est autorisés
			if (in_array($typeFile, $type)) {
				// On vérifie le poids de l'image
				if ($sizeFile < $max_size) {
					// On bouge l'image uploadé dans le dossier upload
					if (move_uploaded_file($tmpFile, './upload/' . $nameFile))
						echo '<center><h8 class="alert alert-success">This picture is uploaded!</h8></center>';
				}
			}
			else{
				$_POST = [];
				echo '<center><h8 class="alert alert-success">check the type!</h8></center>';
			}

	}
}
	public function path()
	{
		$tab = file('./data/text');
		$der_ligne = $tab[count($tab) - 1];
		//echo file_get_contents($der_ligne,FALSE,NULL,2,14);
		$tmp = explode('"', $der_ligne);
		if ($tmp[11] != "") {
			return './upload/' . $_FILES[$this->file]['name'];
			
		}
		if ($tmp[11] == "") {
			return './nopicture/nopicture.png';
		}
	}
}
?>
