<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Contact\Settings;
use App\Mail\ContactSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Save contact form and send as email.
     *
     * @return void
     */
    private function submit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'contact-fullname' => 'required|max:255',
            'contact-company' => 'required|max:255',
            'contact-email' => 'required|max:255|email',
            'contact-phone' => 'required|max:30',
            'contact-message' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new Contact;

        $contact->name = $request['contact-fullname'];
        $contact->company = $request['contact-company'];
        $contact->email = $request['contact-email'];
        $contact->phone = $request['contact-phone'];
        $contact->message = $request['contact-message'];

        $contact->save();

        $mail = new ContactSubmitted($contact);

        /**
         * Pulls values from Settings Valuestore.  If the Valuestore is empty, set to an empty array rather than null
         * since Mail does not accept null values to senders.
         */
        $emailRecipients = $this->settings->get('emailRecipients') ?: [];
        $emailCcs = $this->settings->get('emailCcs') ?: [];
        $emailBccs = $this->settings->get('emailBccs') ?: [];

        Mail::to($emailRecipients)
            ->cc($emailCcs)
            ->bcc($emailBccs)
            ->send($mail);
    }

    public function submitContact(Request $request) {
        $this->submit($request);
        return redirect()->route('thank-you');
    }

    public function submitContactFooter(Request $request) {
        $this->submit($request);
        return redirect()->route('thank-you.footer');
    }
}
