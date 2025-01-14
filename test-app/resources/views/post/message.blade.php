<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ダイレクトメッセージ</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <header class="header">
            <div class="header-container">
                <div class="logo">
                    <h1>ダイレクトメッセージ</h1>
                </div>
                <form class="search-bar" method="GET">
                    <input type="text" name="query" placeholder="検索（例: #ハッシュタグ）">
                    <button type="submit">検索</button>
                </form>
                <div class="user-menu">
                    <img src="{{ asset('images/user-icon.png') }}" alt="ユーザーアイコン" class="user-icon" onclick="toggleUserMenu()">
                    <div id="userMenu" class="dropdown-menu">
                        <a href="#">プロフィール</a>
                        <a href="#">設定</a>
                        <a href="#">ログアウト</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="layout">
            <!-- 左サイドバー -->
            <aside class="sidebar sidebar-left">
                <nav>
                    <ul>
                        <li><a href="toppage">🏠 ホーム</a></li>
                        <li><a href="messages">📩 メッセージ</a></li>
                        <li><a href="#">📂 ファイル共有</a></li>
                        <li><a href="#">👤 プロフィール</a></li>
                    </ul>
                </nav>
            </aside>

            <main class="main-content">
                <div class="message-header">
                    <h2>メッセージ</h2>
                </div>
                <div class="user-list">
                    <ul>
                        @foreach($users as $user)
                            <li><a href="{{ route('messages.show', $user->id) }}">{{ $user->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </main>
        </div>
        <footer class="footer">
            <h6>&copy; 2024 学校SNSサービス</h6>
        </footer>

    </body>
</html>
