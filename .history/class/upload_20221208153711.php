<?php

class upload {
    private $file;

    public function __construct(string $image)
    {
        $this->file = $image;
        if(!empty($_FILES[$image])){
            $nameFile = $_FILES[$image]['name'];
            $typeFile = $_FILES[$image]['type'];
            $sizeFile = $_FILES[$image]['size'];
            $tmpFile = $_FILES[$image]['tmp_name'];
            $errFile = $_FILES[$image]['error'];
        }
    }

}
?>