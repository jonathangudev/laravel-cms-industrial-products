<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSubmitted extends Mailable implements ShouldQueue
{
    use SerializesModels;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'emails';

    /**
     * The email contents
     *
     * @var name, company, email, phone, message
     */
    protected $name;
    protected $company;
    protected $email;
    protected $phone;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @param Contact $contact
     * @return void
     */
    public function __construct(Contact $contact)
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
            'contactName' => $this->name,
            'contactCompany' => $this->company,
            'contactEmail' => $this->email,
            'contactPhone' => $this->phone,
            'contactMessage' => $this->message
        ];

        return $this->markdown('emails.contact-submitted', $data);
    }
}
