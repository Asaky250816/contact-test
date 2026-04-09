<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    tbody tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

</head>
<body>
    <h1>Admin</h1>

    <form method="POST" action="/logout" style="margin-bottom: 20px;">
        @csrf
        <button type="submit">logout</button>
    </form>

    <form method="get" action="/admin">
        <input type="text" name="keyword" placeholder="名前やメールで検索" value="{{ request('keyword') }}">

        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="">カテゴリ</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit">検索</button>
        <a href="/admin">リセット</a>
    </form>

    <form method="get" action="/export" style="display:inline-block; margin-bottom:20px;">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <button type="submit">エクスポート</button>
    </form>

    <table border="1">
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th>削除</th>
        </tr>

        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if ($contact->gender == 1)
                        男性
                    @elseif ($contact->gender == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '' }}</td>
                <td>
                    <form action="/delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

        {{ $contacts->links('pagination::bootstrap-4') }}

</body>
</html>