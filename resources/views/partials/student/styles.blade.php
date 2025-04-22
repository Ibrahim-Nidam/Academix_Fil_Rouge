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
                    blue: '#4260a6',
                    femaleGold: '#e5cf86',
                    absent: '#ef4444',
                    present: '#10b981',
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
    .card {
      @apply bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-100 dark:border-gray-700 transition-all duration-200 hover:shadow-lg;
    }
    .card-time {
      @apply bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 pb-0 border border-gray-100 dark:border-gray-700 transition-all duration-200 hover:shadow-lg;
    }
    .progress-bar {
      @apply h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden;
    }
    .progress-fill {
      @apply h-full rounded-full;
    }
    .progress-fill-high {
      @apply bg-green-500;
    }
    .progress-fill-medium {
      @apply bg-gold;
    }
    .progress-fill-low {
      @apply bg-red-500;
    }
    .badge {
      @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-success {
      @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
    }
    .badge-warning {
      @apply bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200;
    }
    .badge-danger {
      @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
    }
    .timetable-cell {
      @apply text-center text-xs border border-gray-200 dark:border-gray-700;
    }
    .timetable-header {
      @apply bg-gray-100 dark:bg-gray-700 font-medium;
    }
    .timetable-time {
      @apply bg-gray-50 dark:bg-gray-800 font-medium;
    }
    .timetable-class {
      @apply bg-blue/10 p-2 dark:bg-blue/20 hover:bg-blue/20 dark:hover:bg-blue/30 cursor-pointer transition-colors duration-200;
    }
    .timetable-class-active {
      @apply bg-gold/20 dark:bg-gold/30 hover:bg-gold/30 dark:hover:bg-gold/40;
    }

    .grade-badge {
        @apply inline-flex items-center justify-center px-2.5 py-1 rounded-full text-sm font-medium;
      }
      .grade-high {
        @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
      }
      .grade-medium {
        @apply bg-gold/20 text-amber-800 dark:bg-gold/30 dark:text-amber-200;
      }
      .grade-low {
        @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
      }
      .subject-header {
        @apply flex items-center justify-between w-full px-5 py-4 text-left font-medium text-darkText dark:text-lightText transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg;
      }
      .subject-content {
        @apply overflow-hidden transition-all duration-300 max-h-0;
      }
      .subject-content.open {
        @apply max-h-[2000px] animate-slide-down;
      }
      .assessment-card {
        @apply p-4 mb-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-200 hover:shadow-md;
      }

      .attendance-card {
        @apply bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 border-l-4 transition-all duration-200 hover:shadow-lg relative;
      }
      .attendance-card-present {
        @apply border-l-present;
      }
      .attendance-card-absent {
        @apply border-l-absent;
      }
      .attendance-status {
        @apply absolute top-0 right-0 w-16 h-16 flex items-center justify-center transform rotate-45 translate-x-8 -translate-y-8;
      }
      .attendance-status-present {
        @apply bg-present/10 dark:bg-present/20;
      }
      .attendance-status-absent {
        @apply bg-absent/10 dark:bg-absent/20;
      }
      .attendance-day {
        @apply text-sm font-medium text-gray-500 dark:text-gray-400 mb-1;
      }
      .attendance-subject {
        @apply text-lg font-semibold mb-1;
      }
      .attendance-time {
        @apply text-sm text-gray-600 dark:text-gray-300 flex items-center;
      }
      .attendance-badge {
        @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
      }
      .attendance-badge-present {
        @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
      }
      .attendance-badge-absent {
        @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200;
      }
      .tooltip {
        @apply absolute z-10 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gray-900 text-white text-sm rounded-md py-1 px-2 -mt-16 top-11 transform translate-x-1/2 w-max max-w-xs;
      }
      .tooltip::after {
        @apply content-[''] absolute top-full left-1/2 transform -translate-x-1/2 border-8 border-t-gray-900 border-x-transparent border-b-transparent;
      }
      .month-divider {
        @apply flex items-center my-6;
      }
      .month-divider::before, .month-divider::after {
        @apply content-[''] flex-1 border-t border-gray-300 dark:border-gray-700;
      }
      .month-divider::before {
        @apply mr-4;
      }
      .month-divider::after {
        @apply ml-4;
      }

      .teacher-card {
      @apply bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 transition-all duration-200 hover:shadow-lg cursor-pointer;
    }
    .teacher-card-active {
      @apply border-gold dark:border-gold;
    }
    .resource-card {
      @apply bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700 transition-all duration-200 hover:shadow-md flex flex-col md:flex-row;
    }
    .download-btn {
      @apply px-3 py-1.5 bg-gold text-white rounded-md hover:bg-gold/90 transition-colors duration-200 flex items-center justify-center gap-1 text-sm font-medium;
    }
    .grade-header {
      @apply text-lg font-semibold mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 text-darkText dark:text-lightText;
    }
    .resource-group {
      @apply mb-8 last:mb-0;
    }
    .resource-icon {
      @apply p-3 rounded-lg mr-3 flex-shrink-0;
    }
}
</style>