<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
        <h1>FashionablyLate</h1>
        <a href="/login">login</a>
    </header>

    <h2>Register</h2>

    <form method="POST" action="/register" novalidate>
        @csrf

        <div>
            <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
            @error('name')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

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

        <div>
            <input type="password" name="password_confirmation" placeholder="確認用パスワード">
        </div>

        <button type="submit">登録</button>
    </form>
</body>
</html>