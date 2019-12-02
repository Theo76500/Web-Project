<?php
  
namespace App\Mail;
   
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class Command extends Mailable
{
    use Queueable, SerializesModels;
  
    public $details;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
    {
        return $this->subject('Mail de test !')
                    ->view('emails.command');
    }
}