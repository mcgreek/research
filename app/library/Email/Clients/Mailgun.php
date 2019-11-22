<?php
namespace App\Email\Clients;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailgun
 *
 * @author viktor
 */
class Mailgun extends Generic {
    
    public function sendMessage() {
        
   \Mail::send('mail.poll-share', [], function($message)
	{
		$message->subject('Hi There!!');
		$message->from(config('mail.from.address'), \Config::get('mail.from.name'));
		$message->to('viktord@gmail.com');
	});
        /*
        $mgClient = new \Mailgun(env('MAILGUN_SECRET'));
        $domain = env('MAILGUN_DOMAIN');

        $result = $mgClient->sendMessage($domain, array(
                'from'	=> \Config::get('mail.from.name') . "<".\Config::get('mail.from.address').">",
                'to'	=> 'viktord@gmail.com',
                'subject' => 'Poll test',
                'text'	=> 'Testing some Mailgun awesomness!'
        ));
        
        var_dump($result);
         */
    }
}
