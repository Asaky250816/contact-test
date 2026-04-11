<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">FashionablyLate</div>
        </div>
    </header>

    <div class="container">
        <div class="contact-wrapper">
            <h1 class="contact-title">Confirm</h1>

            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @if ($contact['gender'] == 1)
                            男性
                        @elseif ($contact['gender'] == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $contact['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $contact['tel'] }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $contact['address'] }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $contact['building'] }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $category->content }}</td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td class="confirm-detail">{{ $contact['detail'] }}</td>
                </tr>
            </table>

            <div class="confirm-buttons">
                <form action="/thanks" method="post" class="confirm-form">
                    @csrf
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                    <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    <button type="submit" class="confirm-submit">送信</button>
                </form>

                <form action="/" method="get" class="confirm-form">
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                    <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    <button type="submit" class="confirm-edit">修正</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>