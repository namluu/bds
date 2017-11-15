<?php
class Tools extends CI_Controller 
{
    /**
     * php index.php tools message
     * php index.php tools message "Nam Luu"
     */
    public function message($to = 'World')
    {
        echo "Hello {$to}!".PHP_EOL;
    }
}