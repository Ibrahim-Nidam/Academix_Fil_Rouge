<script>
const themeToggle = document.getElementById('theme-toggle');
themeToggle.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
    const isDarkMode = document.documentElement.classList.contains('dark');
    localStorage.setItem('darkMode', isDarkMode);
});

const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
const sidebar = document.querySelector('.fixed.top-0.left-0.h-screen');

mobileSidebarToggle.addEventListener('click', () => {
sidebar.classList.toggle('-translate-x-full');
sidebar.classList.toggle('translate-x-0');
});

function getThemeColors() {
const isDarkMode = document.documentElement.classList.contains('dark');
return {
    textColor: isDarkMode ? '#f3f4f6' : '#1f2937',
    gridColor: isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
    backgroundColor: isDarkMode ? '#1e293b' : '#ffffff'
};
}

function initDarkMode() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDarkMode);
} else {
    initDarkMode();
}

</script>