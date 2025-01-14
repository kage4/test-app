// モーダル操作
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('postModal');
    const openButton = document.querySelector('.show-post-modal');
    const closeButton = document.querySelector('.close-button');

    // モーダルを開く
    openButton.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    // モーダルを閉じる
    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // 外部クリックで閉じる
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Escapeキーで閉じる
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            modal.style.display = 'none';
        }
    });
});
