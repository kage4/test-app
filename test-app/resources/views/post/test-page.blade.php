<!-- filepath: /home/takuya/test-app/resources/views/post/test-page.blade.php -->
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
    <header class="header">
        <div class="header-container">
            <!-- ロゴ -->
            <div class="logo">
                <h1>学校SNS</h1>
            </div>
            <!-- 検索バー -->
            <form class="search-bar" method="GET">
                <input type="text" name="query" placeholder="検索（例: #ハッシュタグ）">
                <button type="submit">検索</button>
            </form>
            <!-- ユーザーメニュー -->
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

    <!-- メインレイアウト -->
    <div class="layout">
        <!-- 左サイドバー -->
        <aside class="sidebar sidebar-left">
            <nav>
                <ul>
                    <li><a href="toppage">🏠 ホーム</a></li>
                    <li><a href="messages">📩 メッセージ</a></li>
                    <li><a href="#">📂 ファイル共有</a></li>
                    <li><a href="#">👤 プロフィール</a></li>
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

        <!-- メインコンテンツ -->
        <main class="main-content">
            <div class="timeline-header">
                <h2>タイムライン</h2>
                <button class="post-button" onclick="openModal()">投稿する</button>
            </div>
            <div class="posts">
                @foreach($timelines as $timeline)
                <div class="post">
                    <div class="post-header">
                        <div class="post">
                        </div>
                        <strong>{{ $timeline->user->name }}</strong>
                        <span>{{ $timeline->created_at->format('Y年m月d日 H:i') }}</span>
                    </div>
                    <p>{{ $timeline->body }}</p>
                    @if($timeline->image)
                    <img src="{{ asset('storage/uploads' . $timeline->image) }}" alt="投稿画像">
                    @endif
                    <div class="post-menu">
                        <button class="delete-button" data-id="{{ $timeline->id }}">削除</button>
                    </div>
                </div>
                @endforeach
            </div>
        </main>

        <!-- 右サイドバー -->
        <aside class="sidebar sidebar-right">
            <h2>オンラインのユーザー</h2>
            <ul>
                <li>ユーザー1</li>
                <li>ユーザー2</li>
                <li>ユーザー3</li>
            </ul>
        </aside>
    </div>

    <!-- モーダル -->
    <div class="modal" id="postModal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2>新しい投稿</h2>
            @if(session('message'))
            <div class="error-message">
                {{ session('message') }}
            </div>
            @endif
            <form method="post" action="{{ route('post.store') }}" method="POST" enctyoe="multipart/form-data">
                @csrf
                <textarea name="body" placeholder="いまどうしてる？" rows="4"></textarea>
                <input type="file" name="image" accept="image/*">
                <button id="postButton"type="submit">投稿</button>
            </form>
        </div>
    </div>

    <!-- フッター -->
    <footer class="footer">
        <h6>&copy; 2024 学校SNSサービス</h6>
    </footer>

    <!-- JavaScript -->
    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-id');
                    if (confirm('本当に削除しますか？')) {
                        fetch(`/posts/${postId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('削除に失敗しました');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
