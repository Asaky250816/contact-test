<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
        <h1>FashionablyLate</h1>
        <a href="/register">register</a>
    </header>

    <h2>Login</h2>

    <form method="POST" action="/login" novalidate>
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