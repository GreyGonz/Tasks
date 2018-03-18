<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index() {
        return view('mail.index');
    }

    public function store(Request $request) {

        dispatch(new SendMail($request->emailto, $request->subject, $request->message));
        return back();
    }
}
