<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
    <h1>Admin</h1>

    <form method="get" action="/admin">
        <input type="text" name="keyword" placeholder="名前やメールで検索" value="{{ request('keyword') }}">

        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <button type="submit">検索</button>
    </form>

    <table border="1">
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
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
            </tr>
        @endforeach
    </table>
</body>
</html>