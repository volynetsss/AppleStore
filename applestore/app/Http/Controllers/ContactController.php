<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactForm;
use App\Mail\ContactFormMail;
use App\Models\Information;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create() {
        $infos = Information::orderBy('created_at')->get();
        return view('contact.contact', ['infos' => $infos]);
    }

    public function store() {
        $data = request()->validate([
            'name' =>  'required',
            'last_name' =>  'required',
            'email' =>  'required|email',
            'message' =>  'required',
        ]);

        Mail::to('applestore@gmail.com')->send(new ContactFormMail($data));

        return redirect(route("contact_form"))->with('success', 'Форма успішно відправлена!');
    }
}
