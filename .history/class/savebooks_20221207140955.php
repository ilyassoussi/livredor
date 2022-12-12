<?php
require_once 'message.php';
    class save{
    private $file;
        public function __construct(string $file){
                $directory = dirname($file);
                if(!is_dir($directory)){
                    mkdir($directory, 0777, true);
                }
                if (!file_exists($file)) {
                    touch($file);
                }
                $this->file = $file;
        }
		 public function addmessage(Message $message):void{
                file_put_contents($this->file, $message->affiche , FILE_APPEND);
        }

    }



?>