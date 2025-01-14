import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        const PostId = button.dataset.id;
           // 確認モーダルを表示
           if (confirm('本当に削除しますか？')) {
            // 削除処理を実行するFetchリクエスト
            fetch(`/posts/${postId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (response.ok) {
                    // 削除成功
                    alert('投稿を削除しました');
                    // 削除された投稿の要素をDOMから削除
                    button.closest('.post').remove();
                } else {
                    // 削除失敗
                    alert('投稿の削除に失敗しました');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});

