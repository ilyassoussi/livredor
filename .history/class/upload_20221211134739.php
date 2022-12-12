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
        $extensions = ['png', 'jpg', 'jpeg', 'gif'];
		// Type d'image 
		$type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
		// On récupère
		$extension = explode('.', $nameFile);
		// Max size
		$max_size = 10000000000;
		
		// On vérifie que le type est autorisés
		if(in_array($typeFile, $type))
		{
			// On vérifie que il n'y a que deux extensions
			if(count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions))
			{
				// On vérifie le poids de l'image
				if($sizeFile < $max_size)
				{
					// On bouge l'image uploadé dans le dossier upload
					if(move_uploaded_file($tmpFile, './upload/'.$nameFile))
						echo '<center><h8 class="alert alert-success">This picture is uploaded!</h8></center>';
				}
				else 
				{
					echo '<center><h8 class="alert alert-danger">image trop lourd ou format incorrect</center></h8>';
				}
			}
			else 
			{
				echo '<center><h8 class="alert alert-danger">Extension de image failed</center></h8>';
			}
		}   
		/*else 
		{
			echo '<center><h8 class="alert alert-danger"></center></h8>';
		}*/


	}
}
    public function path() : string{
            $path = 'upload"\"'.$_FILES[$this->file]['name'];
        return $path;
        }

}
?>