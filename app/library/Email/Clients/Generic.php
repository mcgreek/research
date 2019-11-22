<?php
namespace App\Email\Clients;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Abstract
 *
 * @author viktor
 */
abstract class Generic {
    
    /**
     * Send email to the client
     * 
     * return bool result
     */
    public abstract function sendMessage();
}
