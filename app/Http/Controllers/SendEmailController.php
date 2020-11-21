<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;

class SendEmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        $detail = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ];

        Mail::to('manchestervn1996@gmail.com')->send(new NotifyMail($detail));

        if (Mail::failures()) {
            return response('Sorry! Please try again latter', 500);
        } else {
            return response('Success', 200);
        }
    }
}
