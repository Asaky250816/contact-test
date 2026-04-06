<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
    <h1>Admin</h1>

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