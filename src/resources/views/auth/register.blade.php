<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">FashionablyLate</div>
            <div class="auth-link-nav">
                <a href="/login" class="auth-link-button">login</a>
            </div>
        </div>
    </header>

    <div class="auth-page-bg">
        <div class="auth-wrapper">
            <h1 class="auth-title">Register</h1>

            <div class="auth-card">
                <form action="/register" method="post" class="auth-form">
                    @csrf

                    <div class="auth-row">
                        <label class="auth-label">お名前</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="auth-input" placeholder="例: 山田 太郎">
                        @error('name')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-row">
                        <label class="auth-label">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="auth-input" placeholder="例: test@example.com">
                        @error('email')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-row">
                        <label class="auth-label">パスワード</label>
                        <input type="password" name="password" class="auth-input" placeholder="例: coachtech1106">
                        @error('password')
                            <p class="auth-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-row">
                        <label class="auth-label">確認用パスワード</label>
                        <input type="password" name="password_confirmation" class="auth-input" placeholder="例: coachtech1106">
                    </div>

                    <div class="auth-button-wrap">
                        <button type="submit" class="auth-button">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>