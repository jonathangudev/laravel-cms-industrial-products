<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class ContactController extends Controller
{
    /**
     * Save contact form and send as email.
     *
     * @return \Illuminate\Http\Response
     */

    public function submit(Request $request)
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

        // Uncomment and use Valuestore to get the actual email recipients below

        /*$pathToFile = '';
        $valuestore = Valuestore::make($pathToFile);

        $emailRecipients = $valuestore['email-recipients'];
        $emailCcs   = $valuestore['email-ccs'];
        $emailBccs    = $valuestore['email-bccs'];*/

        $emailRecipients = ['nevin@vividfront.com'];
        $emailCcs = ['jtesta@vividfront.com'];
        $emailBccs = [];

        Mail::to($emailRecipients)
            ->cc($emailCcs)
            ->bcc($emailBccs)
            ->send($mail);

        return redirect()->route('contact')->with('message', 'Your information was submitted!');
    }
}
