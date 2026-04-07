<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form method="POST" action="/login">
        @csrf

        <div>
            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            @error('email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="password" name="password" placeholder="パスワード">
            @error('password')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">ログイン</button>
    </form>
</body>
</html>