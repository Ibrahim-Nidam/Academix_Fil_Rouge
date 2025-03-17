<script src="https://cdn.tailwindcss.com"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    'primary-light': '#f3f4f6',     
                    'primary-dark': '#0d1321',      
                    'primary-text-light': '#1f2937',
                    'primary-text-dark': '#f3f4f6', 
                    'primary-accent': '#d4af37',    
                    gold: '#d4af37',
                    darkBg: '#0d1321',
                    lightBg: '#f3f4f6',
                    darkText: '#1f2937',
                    lightText: '#f3f4f6',
                    maleBlue: '#4260a6',
                    femaleGold: '#e5cf86',
                    absent: '#ef4444',
                    absentDark: '#b91c1c'
                },
                animation: {
                    'fade-in': 'fadeIn 0.3s ease-in-out',
                    'slide-in': 'slideIn 0.3s ease-in-out',
                    'slide-up': 'slideUp 0.5s ease-in-out',
                    'slide-down': 'slideDown 0.5s ease-in-out',
                    'pulse-soft': 'pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    'progress': 'progress 2s ease-in-out',
                    'bounce-small': 'bounceSmall 0.5s ease-in-out'
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0' },
                        '100%': { opacity: '1' }
                    },
                    slideIn: {
                        '0%': { transform: 'translateY(-10px)', opacity: '0' },
                        '100%': { transform: 'translateY(0)', opacity: '1' }
                    },
                    slideUp: {
                        '0%': { transform: 'translateY(20px)', opacity: '0' },
                        '100%': { transform: 'translateY(0)', opacity: '1' }
                    },
                    slideDown: {
                        '0%': { transform: 'translateY(-20px)', opacity: '0' },
                        '100%': { transform: 'translateY(0)', opacity: '1' }
                    },
                    pulseSoft: {
                    '0%, 100%': { opacity: 1 },
                    '50%': { opacity: 0.7 }
                    },
                    progress: {
                    '0%': { width: '0%' },
                    '100%': { width: '100%' }
                    },
                    bounceSmall: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-3px)' }
                    }
                }
            }
        }
    }
</script>

<style type="text/tailwindcss">
@layer utilities {
    .sidebar-icon {
        @apply relative flex items-center justify-center h-12 w-12 mt-2 mb-2 mx-auto
        bg-white dark:bg-gray-800 text-primary-text-light dark:text-primary-text-dark
        hover:bg-primary-accent hover:text-white dark:hover:bg-primary-accent dark:hover:text-white transition-all duration-300 ease-linear cursor-pointer rounded;
    }
    
    .sidebar-tooltip {
        @apply absolute left-full ml-2 rounded-md bg-gray-800 px-2 py-1 text-xs text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100 z-10;
    }
    
    .data-card {
        @apply relative bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 transition-all duration-300 hover:shadow-lg;
    }
    .class-card {
        @apply relative bg-white dark:bg-gray-800 rounded-2xl shadow-md p-4 transition-all duration-300 hover:shadow-lg cursor-pointer;
    }

    .toggle-btn {
    @apply px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200;
    }
    .toggle-btn-active {
    @apply bg-gold text-white;
    }
    .toggle-btn-inactive {
    @apply bg-gray-200 dark:bg-gray-700 text-darkText dark:text-lightText;
    }

    .btn {
        @apply px-4 py-2 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg;
    }
    .btn-primary {
        @apply bg-gold text-white hover:bg-gold/90;
    }
    .btn-outline {
        @apply border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700;
    }
    .btn-blue {
        @apply bg-blue text-white hover:bg-blue/90;
    }
    .toast {
        @apply fixed right-4 bottom-4 z-50 rounded-lg bg-green-500 px-6 py-3 text-white shadow-lg transition-all duration-300 ease-in-out flex items-center gap-2;
        transform: translateY(100px);
        opacity: 0;
    }
    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    .day-item {
        @apply flex flex-col items-center justify-center px-4 py-3 rounded-lg cursor-pointer transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700;
    }
    .day-item.active {
        @apply bg-gold text-white hover:bg-gold/90;
    }
    .attendance-toggle {
        @apply relative inline-flex h-6 w-12 items-center rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gold focus:ring-offset-2 bg-green-500 cursor-pointer;
    }
    .attendance-toggle.absent {
        @apply bg-absent dark:bg-absentDark;
    }
    .attendance-toggle-thumb {
        @apply inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200 translate-x-6;
    }
    .attendance-toggle.absent .attendance-toggle-thumb {
        @apply translate-x-1;
    }
    .attendance-status {
        @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
    }
    .attendance-status-present {
        @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
    }
    .attendance-status-absent {
        @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
    }
    .class-card {
        @apply bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6 transition-all duration-300 hover:shadow-lg border border-gray-100 dark:border-gray-700;
    }
    .class-header {
        @apply p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-700;
    }
    .student-row {
        @apply flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700 last:border-0 transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700;
    }
    .class-selector {
        @apply px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold text-base font-medium min-w-[240px];
    }
    .card {
        @apply bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700;
    }

    .class-card.active {
        @apply border-gold dark:border-gold ring-2 ring-gold/30;
    }
    .form-input {
        @apply w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold;
    }
    .form-select {
        @apply w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold;
    }
    .form-textarea {
        @apply w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold resize-none;
    }
    .grade-input {
        @apply w-20 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold text-center;
    }
    .modal {
        @apply fixed inset-0 z-50 flex items-center justify-center hidden;
    }
    .modal-overlay {
        @apply absolute inset-0 bg-black bg-opacity-50;
    }
    .modal-content {
        @apply relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-md w-full mx-4 p-6 animate-fade-in;
    }

    .resource-card {
        @apply relative bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 transition-all duration-300 hover:shadow-lg cursor-pointer;
    }
    .file-type-icon {
        @apply flex items-center justify-center w-12 h-12 rounded-lg text-white;
    }
    .upload-area {
        @apply border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 transition-all duration-300 text-center;
    }
    .upload-area-active {
        @apply border-gold bg-gold/5;
    }
}
</style>