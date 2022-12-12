<?php

class upload {
    private $file;

    public function __construct(string $image)
    {
        $this->file = $image;
        if(!empty($_FILES['image']))
    }

}
?>