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
		public function addmessage(Message $message):void
        {
                file_put_contents($this->file, $message->affiche() . PHP_EOL  , FILE_APPEND);
        }
    public function getmsg(): array
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        $messagess = [];
        foreach ($lines as $line) {
            $data= json_decode($line, true);
            $messagess[] = new Message($data['titre'], $data['message'], new DateTime("@" . $data['date']));
        }
        return $messages;
    }
    


}
 

?>