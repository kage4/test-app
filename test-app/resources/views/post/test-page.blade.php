<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学校SNSサービス</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <div class="header-container">
            <!-- ヘッダー左：ユーザーアイコン -->
            <div class="user-menu">
                <img src="{{ asset('images/user-icon.png') }}" alt="ユーザーアイコン" class="user-icon" onclick="toggleUserMenu()">
                <div id="userMenu" class="dropdown-menu">
                    <a href="#">プロフィール</a>
                    <a href="#">設定</a>
                    <a href="#">ログアウト</a>
                </div>
            </div>

            <!-- ヘッダー中央：検索バー -->
            <form class="search-bar" method="GET">
                <input type="text" name="query" placeholder="検索（例: #ハッシュタグ）">
                <button type="submit">検索</button>
            </form>

            <!-- ヘッダー右：設定ボタン -->
            <div class="settings-menu">
                <button class="settings-button" onclick="toggleSettingsMenu()">⚙️</button>
                <div id="settingsMenu" class="dropdown-menu">
                    <a href="#">サイト設定</a>
                    <a href="#">テーマ変更</a>
                </div>
            </div>
        </div>
    </header>

   <!-- メインレイアウト -->
   <div class="layout">
    <!-- 左サイドバー：メニュー -->
    <aside class="sidebar-left">
        <nav>
            <h2>メニュー</h2>
            <ul>
                <li><a href="#">タイムライン</a></li>
                <li><a href="#">メッセージ</a></li>
                <li><a href="#">ファイル共有</a></li>
                <li><a href="#">プロフィール</a></li>
                <li> @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                ログイン済み
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a><br>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif</li>
            </ul>
        </nav>
    </aside>

    <!-- メインコンテンツ：中央 -->
    <main class="main-content">
        <section class="content">
            <h2>タイムライン</h2>
            <div class="posts">
                @foreach($timelines as $timeline)
                <div class="post">
                    <h3>{{ $timeline->user->name }}</h3>
                    <p>{{ $timeline->body }}</p>
                    <span>{{ $timeline->created_at->format('Y年m月d日 H:i') }}</span>
                </div>
                @endforeach
            </div>
        </section>
    </main>

    <!-- 右サイドバー：オンラインユーザー -->
    <aside class="sidebar-right">
        <h2>オンラインのユーザー</h2>
        <ul>
            <li>ユーザー1</li>
            <li>ユーザー2</li>
            <li>ユーザー3</li>
            <!-- 他のオンラインユーザーをリストで表示 -->
        </ul>
    </aside>
</div>

<div class="modal" id="postModal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <h2>新しい投稿</h2>
        @if(session('message'))
        <div class="text-red-600 font-bold">
            {{session('message')}}
        </div>
        @endif
        <form method="post" action="{{ route('post.store') }}">
            @csrf
            <label for="body" class="form-label">投稿内容</label>
            <textarea name="body" placeholder="いまどうしてる？" rows="4"></textarea>
            <button id="postButton"type="submit">投稿</button>

        </form>
    </div>
</div>



    <!-- フッター -->
    <footer>
        <button class="show-post-modal" onclick="openModal()">投稿する</button>
        <h6> &copy; 2024 学校SNSサービス</h6>
    </footer>

    <!-- JavaScript -->
    <script>
        function openModal() {
            document.getElementById('postModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('postModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('postModal');
            if (event.target == modal) {
                closeModal();
            }
        }

    </script>
</body>
</html>
