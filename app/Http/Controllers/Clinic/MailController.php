<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        //for testing purposes, kahit wala na to rekta sa mga controller na gagana nadin un
        $details = [
            'title' => 'Mr Jams Title of Email',
            'body' => 'Message to ng email',
        ];

        $recipient = "ragunayon@gmail.com";

        Mail::to($recipient)->send(new EmailNotification($details));
        return "Email Sent";
    }
}
