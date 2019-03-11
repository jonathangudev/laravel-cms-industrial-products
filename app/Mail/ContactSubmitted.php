<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The email contents
     *
     * @var name
     */
    protected $name;
    protected $company;
    protected $email;
    protected $phone;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->name = $contact->name;
        $this->company =  $contact->company;
        $this->email =  $contact->email;
        $this->phone =  $contact->phone;
        $this->message =  $contact->message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'name' => $this->name,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message
        ];

        return $this->view('emails.contact-submitted')->with($data);
    }
}
