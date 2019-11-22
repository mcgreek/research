<?php

namespace App\Email;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sender
 *
 * @author viktor
 */
class Sender {
    
    private $driver;
    
    /**
     *
     * @var \App\Email\Clients\Generic Driver for sending emails
     */
    private $mailDriver;
    
    public function __construct(string $driver = 'mailgun') {
        $this->driver = $driver;
        
        $className = "\\App\\Email\\Clients\\" . ucfirst($driver);
        $this->mailDriver = new $className();
    }
    
    public function email() 
    {
        return $this->mailDriver->sendMessage();
    }
}
