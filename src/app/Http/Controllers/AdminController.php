<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // キーワード検索（名前・メール）
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        // 性別検索
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        $contacts = $query->latest()->get();

        return view('admin', compact('contacts'));
    }
}