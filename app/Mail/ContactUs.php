<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $sender; 
    public $subject; 
    public $body;

    // Receiver Address
    public $receiver = 'example@domain.com';
    

    //Create a new message instance.

    public function __construct($name, $sender, $subject, $body)
    {
        $this->name = $name;
        $this->sender = $sender; 
        $this->subject = $subject;
        $this->body = $body;
    }


    //Build the message.

    public function build()
    {
        return $this->to($this->receiver)
                    ->from($this->sender, $this->name)
                    ->subject($this->subject)
                    ->markdown('emails.contact-us')
                    ->with([
                        'name' => $this->name,
                        'body' => $this->body,           
                    ]);
    }
}
