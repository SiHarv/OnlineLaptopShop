document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const mainContent = document.querySelector('.main-content');
    
    // Create backdrop element
    const backdrop = document.createElement('div');
    backdrop.className = 'sidebar-backdrop';
    document.body.appendChild(backdrop);

    // Toggle sidebar and backdrop
    function toggleSidebar() {
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('show');
    }

    // Close sidebar and backdrop
    function closeSidebar() {
        sidebar.classList.remove('show');
        backdrop.classList.remove('show');
    }

    // Event listeners
    sidebarToggle.addEventListener('click', toggleSidebar);
    backdrop.addEventListener('click', closeSidebar);

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggle = sidebarToggle.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
            closeSidebar();
        }
    });
});