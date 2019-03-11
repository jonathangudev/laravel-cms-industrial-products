<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Contact;
use Illuminate\Http\Request;
use Validator;
use App\Mail\ContactSubmitted;


class ContactController extends Controller
{

    /**
     * Save contact form and send as email.
     *
     * @return \Illuminate\Http\Response
     */

    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
    		'contact-fullname'	=> 'required|max:255',
    		'contact-company'	=> 'required|max:255',
    		'contact-email'		=> 'required|max:255|email',
    		'contact-phone'		=> 'required|max:30',
    		'contact-message'	=> 'nullable'
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

		/*$pathToFile = '';
		$valuestore = Valuestore::make($pathToFile);

		$emailRecipients = $valuestore['email-recipients']; 
		$emailCcs   = $valuestore['email-ccs'];
		$emailBccs	= $valuestore['email-bccs'];*/

    	$mail = new ContactSubmitted($contact);

    	Mail::to('jgu@vividfront.com')
    		->send($mail);

    	return redirect()->route('contact')->with('message', 'Your information was submitted!');
    }
}

