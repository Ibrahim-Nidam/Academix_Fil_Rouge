<!-- TailwindCSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
  tailwind.config = {
  darkMode: 'class',
  theme: {
      extend: {
          colors: {
              primary: {
                  light: '#f3f4f6',
                  dark: '#0d1321',
                  text: {
                      light: '#1f2937',
                      dark: '#f3f4f6'
                  },
                  accent: '#d4af37',
                  blue: '#4260a6',
                  yellow: '#e5cf86',
                  present: '#7a92ca',
                  absent: '#d4af37',
                  late: '#bdc9e5',
                  setting:'#718EBF',
                  performance: {
                      high: '#4260a6',
                      medium: '#5c7aa4',
                      low: '#d4af37'
                    }
              }
          }
      }
  }
}
</script>

<style type="text/tailwindcss">
@layer utilities {
  .circle-progress {
      position: relative;
      height: 150px;
      width: 150px;
      border-radius: 50%;
      display: grid;
      place-items: center;
    }
    
  .circle-progress::before {
      content: "";
      position: absolute;
      height: 120px;
      width: 120px;
      border-radius: 50%;
      background-color: inherit;
  }
  
  .sidebar-icon {
    @apply relative flex items-center justify-center h-12 w-12 mt-2 mb-2 mx-auto
    bg-white dark:bg-gray-800 text-primary-text-light dark:text-primary-text-dark
    hover:bg-primary-accent hover:text-white dark:hover:bg-primary-accent dark:hover:text-white transition-all duration-300 ease-linear cursor-pointer rounded;
  }

  .sidebar-tooltip {
    @apply absolute left-full ml-2 rounded-md bg-gray-800 px-2 py-1 text-xs text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100 z-10;
  }

  .chart-container {
    @apply relative w-full h-full;
  }

  .btn {
    @apply px-4 py-2 rounded-md font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-opacity-50;
  }

  .btn-primary {
    @apply bg-primary-accent text-white hover:bg-opacity-90 focus:ring-primary-accent;
  }

  .btn-secondary {
    @apply bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 focus:ring-gray-400 dark:focus:ring-gray-500;
  }

  .btn-danger {
    @apply bg-red-500 text-white hover:bg-red-600 focus:ring-red-500;
  }

  .btn-sm {
    @apply px-2 py-1 text-sm;
  }

  .form-input {
    @apply w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-accent focus:border-primary-accent;
  }

  .form-select {
    @apply w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-accent focus:border-primary-accent;
  }

  .form-label {
    @apply block text-sm font-medium mb-1;
  }

  .table-row-hover {
    @apply hover:bg-gray-50 dark:hover:bg-gray-700;
  }

  .badge {
    @apply px-2 py-1 rounded-full text-xs font-medium;
  }

  .badge-blue {
    @apply bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100;
  }

  .badge-green {
    @apply bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100;
  }

  .badge-gray {
    @apply bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100;
  }

  .badge-red {
    @apply bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100;
  }

  /* FullCalendar Custom Styling */
  .fc-theme-standard .fc-scrollgrid {
    @apply border-gray-200 dark:border-gray-700;
  }

  .fc-theme-standard td, .fc-theme-standard th {
    @apply border-gray-200 dark:border-gray-700;
  }

  .fc .fc-daygrid-day-number {
    @apply text-primary-text-light dark:text-primary-text-dark;
  }

  .fc .fc-col-header-cell-cushion {
    @apply text-primary-text-light  font-medium;
  }

  .fc .fc-toolbar-title {
    @apply text-primary-text-light dark:text-primary-text-dark text-xl font-bold;
  }

  .fc .fc-button-primary {
    @apply bg-primary-accent border-primary-accent hover:bg-opacity-90 hover:border-opacity-90;
  }

  .fc .fc-button-primary:not(:disabled):active,
  .fc .fc-button-primary:not(:disabled).fc-button-active {
    @apply bg-primary-accent border-primary-accent opacity-90;
  }

  .fc .fc-button-primary:disabled {
    @apply bg-primary-accent border-primary-accent opacity-50;
  }

  .fc-event {
    @apply cursor-pointer;
  }

  .fc-event-title {
    @apply font-medium;
  }

  .fc-daygrid-event {
    @apply rounded-md py-1 px-2;
  }

  .fc-h-event {
    @apply border-0;
  }

  .fc-day-today {
    @apply bg-blue-50 dark:bg-blue-900/20 !important;
  }

  .fc-day-other {
    @apply bg-gray-50 dark:bg-gray-800/50;
  }

  .event-math {
    @apply bg-blue-100 dark:bg-blue-800 border-blue-200 dark:border-blue-700 text-blue-800 dark:text-blue-100;
  }

  .event-history {
    @apply bg-amber-100 dark:bg-amber-800 border-amber-200 dark:border-amber-700 text-amber-800 dark:text-amber-100;
  }

  .event-science {
    @apply bg-green-100 dark:bg-green-800 border-green-200 dark:border-green-700 text-green-800 dark:text-green-100;
  }

  .event-english {
    @apply bg-purple-100 dark:bg-purple-800 border-purple-200 dark:border-purple-700 text-purple-800 dark:text-purple-100;
  }

  .event-art {
    @apply bg-pink-100 dark:bg-pink-800 border-pink-200 dark:border-pink-700 text-pink-800 dark:text-pink-100;
  }

  .event-meeting {
    @apply bg-gray-100 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-100;
  }

  .event-teacher {
    @apply border-l-4 border-l-blue-500 dark:border-l-blue-400;
  }

  .event-class {
    @apply border-l-4 border-l-green-500 dark:border-l-green-400;
  }
}
</style>