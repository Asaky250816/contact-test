<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
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
            <h1 class="contact-title">Contact</h1>

            <form action="/confirm" method="post" class="contact-form">
                @csrf

                <div class="form-row">
                    <div class="form-label">
                        お名前
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <div class="form-name">
                            <div class="name-box">
                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-input"
                                    placeholder="例: 山田"
                                    value="{{ old('last_name', request('last_name')) }}"
                                >
                                @error('last_name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="name-box">
                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-input"
                                    placeholder="例: 太郎"
                                    value="{{ old('first_name', request('first_name')) }}"
                                >
                                @error('first_name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">
                        性別
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <div class="form-radio">
                            <label><input type="radio" name="gender" value="1" {{ old('gender', request('gender')) == '1' ? 'checked' : '' }}> 男性</label>
                            <label><input type="radio" name="gender" value="2" {{ old('gender', request('gender')) == '2' ? 'checked' : '' }}> 女性</label>
                            <label><input type="radio" name="gender" value="3" {{ old('gender', request('gender')) == '3' ? 'checked' : '' }}> その他</label>
                        </div>
                        @error('gender')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">
                        メールアドレス
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <input
                            type="text"
                            name="email"
                            class="form-input"
                            placeholder="例: test@example.com"
                            value="{{ old('email', request('email')) }}"
                        >
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">
                        電話番号
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <div class="form-tel">
                            <input type="text" name="tel1" class="form-input" placeholder="080" value="{{ old('tel1', request('tel1')) }}">
                            <span class="tel-hyphen">-</span>
                            <input type="text" name="tel2" class="form-input" placeholder="1234" value="{{ old('tel2', request('tel2')) }}">
                            <span class="tel-hyphen">-</span>
                            <input type="text" name="tel3" class="form-input" placeholder="5678" value="{{ old('tel3', request('tel3')) }}">
                        </div>

                        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                            <p class="error-message">
                                {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">
                        住所
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <input
                            type="text"
                            name="address"
                            class="form-input"
                            placeholder="例: 東京都渋谷区..."
                            value="{{ old('address', request('address')) }}"
                        >
                        @error('address')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">建物名</div>
                    <div class="form-control">
                        <input
                            type="text"
                            name="building"
                            class="form-input"
                            placeholder="例: 千駄ヶ谷マンション101"
                            value="{{ old('building', request('building')) }}"
                        >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">
                        お問い合わせの種類
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <select name="category_id" class="form-select">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row form-row--textarea">
                    <div class="form-label">
                        お問い合わせ内容
                        <span class="required">※</span>
                    </div>
                    <div class="form-control">
                        <textarea
                            name="detail"
                            class="form-textarea"
                            placeholder="お問い合わせ内容をご記載ください"
                        >{{ old('detail', request('detail')) }}</textarea>
                        @error('detail')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-button">
                    <button type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>