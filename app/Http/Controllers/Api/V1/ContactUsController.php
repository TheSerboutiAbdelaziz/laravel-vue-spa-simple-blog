<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use Mail;
use App\Mail\ContactUs;
class ContactUsController extends Controller
{

    //Hundle contact resource .

    public function send(ContactUsRequest $request)
    {
    	// Sender info
        $name = $request->input('name');
        $sender = $request->input('address');
        $subject = $request->input('subject');
        $body = $request->input('body');

        // Sender mail
        Mail::send(new ContactUs($name, $sender, $subject, $body));

        return response()->json(['message' => 'Sent successfully!']);
    }

}
