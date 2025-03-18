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