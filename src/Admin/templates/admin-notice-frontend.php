<style>
    .cpa-frontend-notice {
        width: 100%;
        padding: 12px 20px;
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        border-left: 4px solid #dc3545;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 14px;
        line-height: 1.4;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease-in-out;
    }

    .cpa-frontend-notice.fixed {
        position: fixed;
        top: 32px;
        left: 0;
        z-index: 9999;
    }

    .cpa-frontend-notice:hover {
        background-color: #f5c6cb;
    }
</style>
<script>
document.addEventListener('scroll', () => {
    const notice = document.getElementById('cpa-frontend-notice');
    if (!notice) return;

    if (window.scrollY > 10) {
        notice.classList.add('fixed');
    } else {
        notice.classList.remove('fixed');
    }
});
</script>
<div id="cpa-frontend-notice" class="cpa-frontend-notice">
    <?php require_once __DIR__ . '/notice.php'; ?>
</div>