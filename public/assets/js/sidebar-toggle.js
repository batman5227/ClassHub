// ClassHub Futuristic Sidebar JavaScript

document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");

    // Load saved state from localStorage
    if (localStorage.getItem("sidebarCollapsed") === "true") {
        if (sidebar) {
            sidebar.classList.add("collapsed");
            document.body.classList.add("sidebar-collapsed");
        }
    }

    // Toggle sidebar
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            sidebar.classList.toggle("collapsed");
            const isCollapsed = sidebar.classList.contains("collapsed");
            localStorage.setItem("sidebarCollapsed", isCollapsed);

            // Add/remove body class for CSS targeting
            if (isCollapsed) {
                document.body.classList.add("sidebar-collapsed");
            } else {
                document.body.classList.remove("sidebar-collapsed");
            }
        });
    }

    // Initialize all menu items with submenus
    initializeSubmenus();
});

function initializeSubmenus() {
    // Get all menu items that have submenus
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(function(item) {
        const link = item.querySelector('.menu-link');
        const submenu = item.querySelector('.submenu');

        if (link && submenu) {
            // Add click event to toggle submenu
            link.addEventListener('click', function(e) {
                // Don't toggle if it's a link (href exists and is not #)
                const href = link.getAttribute('href');
                if (href && href !== '#' && !href.startsWith('javascript')) {
                    return; // Let the link work normally
                }

                e.preventDefault();
                e.stopPropagation();

                toggleSubmenu(item);
            });
        }
    });
}

function toggleSubmenu(menuItem) {
    if (!menuItem) return;

    const submenu = menuItem.querySelector('.submenu');
    const link = menuItem.querySelector('.menu-link');
    const arrow = link ? link.querySelector('.arrow') : null;

    if (!submenu) return;

    // Check if already open
    const isOpen = submenu.classList.contains('open');

    // Close all other submenus first
    const allSubmenus = document.querySelectorAll('.submenu.open');
    allSubmenus.forEach(function(sm) {
        if (sm !== submenu) {
            sm.classList.remove('open');
            const parent = sm.closest('.menu-item');
            if (parent) {
                const parentLink = parent.querySelector('.menu-link');
                const parentArrow = parentLink ? parentLink.querySelector('.arrow') : null;
                if (parentArrow) {
                    parentArrow.classList.remove('rotate');
                }
            }
        }
    });

    // Toggle current submenu
    if (isOpen) {
        submenu.classList.remove('open');
        if (arrow) {
            arrow.classList.remove('rotate');
        }
    } else {
        submenu.classList.add('open');
        if (arrow) {
            arrow.classList.add('rotate');
        }
    }
}

// Make toggleSubmenu available globally
window.toggleSubmenu = toggleSubmenu;

// Mobile sidebar toggle
function toggleMobileSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar) {
        sidebar.classList.toggle("active");
    }
}

// Close mobile sidebar when clicking outside
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");

    if (sidebar && window.innerWidth <= 991) {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.remove("active");
        }
    }
});
