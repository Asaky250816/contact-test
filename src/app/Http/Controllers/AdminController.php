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

if ($request->keyword) {
    $keyword = $request->keyword;
    $keywordNoSpace = str_replace([' ', '　'], '', $keyword);

    $query->where(function ($q) use ($keyword, $keywordNoSpace) {
        $q->where('first_name', 'like', '%' . $keyword . '%')
            ->orWhere('last_name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $keywordNoSpace . '%'])
            ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ['%' . $keywordNoSpace . '%'])
            ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $keyword . '%'])
            ->orWhereRaw("CONCAT(last_name, '　', first_name) LIKE ?", ['%' . $keyword . '%']);
    });
}

        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

        public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->get();

        $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
            '作成日',
        ];

        $callback = function () use ($contacts, $csvHeader) {
            $stream = fopen('php://output', 'w');

            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);
            fputcsv($stream, $csvHeader);

            foreach ($contacts as $contact) {
                $gender = '';
                if ($contact->gender == 1) {
                    $gender = '男性';
                } elseif ($contact->gender == 2) {
                    $gender = '女性';
                } else {
                    $gender = 'その他';
                }

                $row = [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at,
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $row);
                fputcsv($stream, $row);
            }

            fclose($stream);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=contacts.csv',
        ];

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}