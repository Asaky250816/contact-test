<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>
    <h1>Contact</h1>

    <form action="/confirm" method="post">
        @csrf

        <div>
            <label>お名前 ※</label>
            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name', request('last_name')) }}">
            @error('last_name')
            <p style="color:red;">{{ $message }}</p>
            @enderror
            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', request('first_name')) }}">
            @error('first_name')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>性別 ※</label>
                <label><input type="radio" name="gender" value="1" {{ old('gender', request('gender')) == '1' ? 'checked' : '' }}> 男性</label>
                <label><input type="radio" name="gender" value="2" {{ old('gender', request('gender')) == '2' ? 'checked' : '' }}> 女性</label>
                <label><input type="radio" name="gender" value="3" {{ old('gender', request('gender')) == '3' ? 'checked' : '' }}> その他</label>
                @error('gender')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
        </div>

        <div>
            <label>メールアドレス ※</label>
            <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email', request('email')) }}">
            @error('email')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>電話番号 ※</label>
            <input type="text" name="tel1" value="{{ old('tel1', request('tel1')) }}">
            <input type="text" name="tel2" value="{{ old('tel2', request('tel2')) }}">
            <input type="text" name="tel3" value="{{ old('tel3', request('tel3')) }}">

            @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                <p style="color:red;">
                    {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                </p>
            @endif
        </div>

        <div>
            <label>住所 ※</label>
            <input type="text" name="address" placeholder="例: 東京都渋谷区..." value="{{ old('address', request('address')) }}">
            @error('address')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>建物名</label>
            <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', request('building')) }}">
        </div>

        <div>
            <label>お問い合わせの種類 ※</label>
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

                @error('category_id')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
        </div>

        <div>
            <label>お問い合わせ内容 ※</label>
            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', request('detail')) }}</textarea>
            @error('detail')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">確認画面</button>
    </form>
</body>
</html>