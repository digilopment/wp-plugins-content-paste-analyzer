document.addEventListener('DOMContentLoaded', function() {
    const editor = document.getElementById('content');
    if (!editor) return;
    editor.addEventListener('paste', function() {
        fetch(ajaxurl, {
            method: 'POST',
            credentials: 'same-origin',
            body: new URLSearchParams({
                action: 'cpa_mark_paste',
                post_id: editor.dataset.postId
            })
        });
    });
});