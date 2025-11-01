jQuery(function ($) {
    let sent = false;

    function markPostAsDirty() {
        if (sent)
            return;
        const postId = $('#post_ID').val() || (typeof cpaAjax !== 'undefined' ? cpaAjax.postId : 0);
        if (!postId)
            return;
        sent = true;

        $.ajax({
            url: cpaAjax.ajaxUrl,
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'cpa_mark_paste',
                post_id: postId,
                security: cpaAjax.nonce
            },
            success: function (data) {
                console.log('Content marked as dirty', data);
            },
            error: function (xhr, status, error) {
                console.error('Failed to mark post as dirty', error);
            }
        });
    }

    // Textarea
    $('#content').on('paste', markPostAsDirty);

    // TinyMCE
    if (typeof tinymce !== 'undefined') {
        tinymce.on('AddEditor', function (e) {
            e.editor.on('paste', markPostAsDirty);
        });
        if (tinymce.activeEditor) {
            tinymce.activeEditor.on('paste', markPostAsDirty);
        }
    }
});
