<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Mail;
use App\Mail\DefaultMail;

class MailController extends Controller
{
    public function index() {
        return view('mail.index');
    }
    public function store(Request $request) {
        dump($request->emailto);
        Mail::to($request->emailto)
            ->send(new DefaultMail($request->subject, $request->content));
        
        return back();
    }
}
