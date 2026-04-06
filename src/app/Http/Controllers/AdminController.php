<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->latest()->get();

        return view('admin', compact('contacts'));
    }
}