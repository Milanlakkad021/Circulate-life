<script src="../js/script.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar-nav');
        var main = document.querySelector('.main');
        if (sidebar.classList.contains('sidebar-hidden')) {
            sidebar.classList.remove('sidebar-hidden');
            main.classList.remove('main-collapsed');
            main.classList.add('main-expanded');
        } else {
            sidebar.classList.add('sidebar-hidden');
            main.classList.remove('main-expanded');
            main.classList.add('main-collapsed');
        }
    }
</script>