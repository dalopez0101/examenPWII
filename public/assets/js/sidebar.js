
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.querySelector('.sidebar-wrapper');
    const toggleBtn = document.querySelector('#sidebar-toggle');

    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('show');
            overlay.classList.toggle(
                'show',
                sidebar.classList.contains('show')
            );
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

    const desktopToggleBtn = document.querySelector('#desktop-sidebar-toggle');

    if (desktopToggleBtn) {
        desktopToggleBtn.addEventListener('click', function () {
            document.body.classList.toggle('sidebar-minimized');
        });
    }

});
