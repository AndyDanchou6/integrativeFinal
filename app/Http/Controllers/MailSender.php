<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Usermail;
use Illuminate\Support\Facades\Mail;

class MailSender extends Controller
{
    public function sendMail(Request $request)
    {
        try {
            Mail::to($request['email'])->send(new Usermail($request['username'], $request['email'], $request['password']));
            return response()->json([
                'status' => 200,
                'message' => 'Sent successfully'
            ]);
            // return ($request['username']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
}
