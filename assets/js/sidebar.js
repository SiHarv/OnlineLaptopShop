document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const backdrop = document.querySelector('.sidebar-backdrop');

    if (!backdrop) {
        const newBackdrop = document.createElement('div');
        newBackdrop.className = 'sidebar-backdrop';
        document.body.appendChild(newBackdrop);
    }

    sidebarToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        sidebar.classList.toggle('show');
        document.querySelector('.sidebar-backdrop').classList.toggle('show');
    });

    document.querySelector('.sidebar-backdrop').addEventListener('click', function() {
        sidebar.classList.remove('show');
        this.classList.remove('show');
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', function(e) {
        if (!sidebar.contains(e.target) && 
            !sidebarToggle.contains(e.target) && 
            sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
            document.querySelector('.sidebar-backdrop').classList.remove('show');
        }
    });
});