<style>
.cpa-frontend-notice {
    width: 100%;
    background-color: #fff3cd;
    color: #856404;
    padding: 8px 16px;
    font-family: sans-serif;
    font-size: 14px;
    transition: all 0.2s ease;
}
.cpa-frontend-notice.fixed {
    position: fixed;
    top: 32px;
    left: 0;
    z-index: 9999;
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