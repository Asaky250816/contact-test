<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

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

        // カテゴリ検索
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $contacts = $query->latest()->get();
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
            }
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}