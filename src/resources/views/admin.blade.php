<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    </head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">FashionablyLate</div>
            <nav class="header__nav">
                <form method="POST" action="/logout" class="header__logout-form">
                    @csrf
                    <button type="submit" class="header__link">logout</button>
                </form>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="admin-inner">
        <h1 class="page-title">Admin</h1>

        <form method="get" action="/admin" class="admin-search">
            <input
                type="text"
                name="keyword"
                placeholder="名前やメールで検索"
                value="{{ request('keyword') }}"
                class="admin-search__input"
            >

            <select name="gender" class="admin-search__select">
                <option value="">全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id" class="admin-search__select">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="admin-search__date"
            >

            <button type="submit" class="admin-search__button">検索</button>
            <a href="/admin" class="admin-search__reset">リセット</a>
        </form>

        <div class="admin-toolbar">
            <form method="get" action="/export" class="admin-export-form">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button type="submit" class="admin-export">エクスポート</button>
            </form>

            <div class="pagination-wrapper">
                {{ $contacts->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th>詳細</th>
                    <th>削除</th>
                </tr>
            </thead>

            <tbody>
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
                            <button
                                type="button"
                                onclick="openModal(this)"
                                class="admin-detail-button"
                                data-id="{{ $contact->id }}"
                                data-last_name="{{ $contact->last_name }}"
                                data-first_name="{{ $contact->first_name }}"
                                data-gender="{{ $contact->gender }}"
                                data-email="{{ $contact->email }}"
                                data-tel="{{ $contact->tel }}"
                                data-address="{{ $contact->address }}"
                                data-building="{{ $contact->building }}"
                                data-category="{{ $contact->category->content ?? '' }}"
                                data-detail="{{ $contact->detail }}"
                            >
                                詳細
                            </button>
                        </td>

                        <td>
                            <form action="/delete" method="post" class="admin-delete-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <button type="submit" class="admin-delete-button">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <button type="button" onclick="closeModal()" class="modal-close">&times;</button>

            <div class="modal-body">
                <div class="modal-row">
                    <div class="modal-label">お名前</div>
                    <div class="modal-value" id="modal-name"></div>
                </div>

                <div class="modal-row">
                    <div class="modal-label">性別</div>
                    <div class="modal-value" id="modal-gender"></div>
                </div>

                <div class="modal-row">
                    <div class="modal-label">メールアドレス</div>
                    <div class="modal-value" id="modal-email"></div>
                </div>

                <div class="modal-row">
                    <div class="modal-label">電話番号</div>
                    <div class="modal-value" id="modal-tel"></div>
                </div>

                <div class="modal-row">
                    <div class="modal-label">住所</div>
                    <div class="modal-value" id="modal-address"></div>
                </div>

                <div class="modal-row">
                    <div class="modal-label">建物名</div>
                    <div class="modal-value" id="modal-building"></div>
                </div>

                <div class="modal-row">
                    <div class="modal-label">お問い合わせの種類</div>
                    <div class="modal-value" id="modal-category"></div>
                </div>

                <div class="modal-row modal-row--textarea">
                    <div class="modal-label">お問い合わせ内容</div>
                    <div class="modal-value" id="modal-detail"></div>
                </div>
            </div>

            <div class="modal-footer">
                <form action="/delete" method="post" class="modal-delete-form">
                    @csrf
                    <input type="hidden" name="id" id="modal-contact-id">
                    <button type="submit" class="modal-delete-button">削除</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(button) {
            const id = button.dataset.id;
            const lastName = button.dataset.last_name;
            const firstName = button.dataset.first_name;
            const gender = button.dataset.gender;
            const email = button.dataset.email;
            const tel = button.dataset.tel;
            const address = button.dataset.address;
            const building = button.dataset.building;
            const category = button.dataset.category;
            const detail = button.dataset.detail;

            let genderText = '';
            if (gender == 1) {
                genderText = '男性';
            } else if (gender == 2) {
                genderText = '女性';
            } else {
                genderText = 'その他';
            }

            document.getElementById('modal-contact-id').value = id;
            document.getElementById('modal-name').textContent = lastName + ' ' + firstName;
            document.getElementById('modal-gender').textContent = genderText;
            document.getElementById('modal-email').textContent = email;
            document.getElementById('modal-tel').textContent = tel;
            document.getElementById('modal-address').textContent = address;
            document.getElementById('modal-building').textContent = building ? building : 'ー';
            document.getElementById('modal-category').textContent = category;
            document.getElementById('modal-detail').textContent = detail;

            document.getElementById('detailModal').classList.add('is-open');
        }

        function closeModal() {
            document.getElementById('detailModal').classList.remove('is-open');
        }

        window.addEventListener('click', function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeModal();
            }
        });
    </script>
</body>
</html>