document.addEventListener('DOMContentLoaded', function () {
    let sent = false;

    function markPostAsDirty() {
        if (sent) return;
        const postId = document.getElementById('post_ID')?.value || (cpaAjax ? cpaAjax.postId : 0);
        if (!postId) return;
        sent = true;

        fetch(cpaAjax.ajaxUrl, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            body: new URLSearchParams({
                action: 'cpa_mark_paste',
                post_id: postId,
                security: cpaAjax.nonce
            })
        })
        .then(r => r.json())
        .then(data => console.log('Content marked as dirty', data))
        .catch(err => console.error('Failed to mark post as dirty', err));
    }

    // Textarea
    document.getElementById('content')?.addEventListener('paste', markPostAsDirty);

    // TinyMCE
    if (typeof tinymce !== 'undefined') {
        tinymce.on('AddEditor', function(e) {
            e.editor.on('paste', markPostAsDirty);
        });
        if (tinymce.activeEditor) tinymce.activeEditor.on('paste', markPostAsDirty);
    }
});
