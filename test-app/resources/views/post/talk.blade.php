<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トーク - {{ $user->name }}</title>
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
                        <li><a href="../toppage">🏠 ホーム</a></li>
                        <li><a href="../messages">📩 メッセージ</a></li>
                        <li><a href="#">📂 ファイル共有</a></li>
                        <li><a href="#">👤 プロフィール</a></li>
                    </ul>
                </nav>
            </aside>

            <main class="main-content">
                <div class="message-header">
                    <h2>{{ $user->name }}とのトーク</h2>
                </div>
                <div class="message-form">
                    <form method="post" action="{{ route('messages.store') }}">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <textarea name="body" placeholder="メッセージを入力" rows="4" required></textarea>
                        <button type="submit">送信</button>
                    </form>
                </div>
                <div class="messages">
                    <div class="baloon_1">
                    @foreach($messages as $message)
                        <div class="message">
                            <strong>{{ $message->sender->name }} → {{ $message->receiver->name }}</strong>
                            <p class="says">{{ $message->body }}</p>
                            <span>{{ $message->created_at->format('Y年m月d日 H:i') }}</span>
                        </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
        <footer class="footer">
            <h6>&copy; 2024 学校SNSサービス</h6>
        </footer>

    </body>
</html>
