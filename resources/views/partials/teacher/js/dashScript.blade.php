<script>
document.addEventListener('DOMContentLoaded', function() {
const dateElement = document.getElementById('currentDate');
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
const today = new Date();
const dateString = today.toLocaleDateString('en-US', options);
dateElement.textContent = `${dateString} — Here's your daily overview`;

const topPerformersBtn = document.getElementById('topPerformersBtn');
const lowestPerformersBtn = document.getElementById('lowestPerformersBtn');
const topPerformers = document.getElementById('topPerformers');
const lowestPerformers = document.getElementById('lowestPerformers');

topPerformersBtn.addEventListener('click', () => {
    topPerformersBtn.classList.add('toggle-btn-active');
    topPerformersBtn.classList.remove('toggle-btn-inactive');
    lowestPerformersBtn.classList.add('toggle-btn-inactive');
    lowestPerformersBtn.classList.remove('toggle-btn-active');

    lowestPerformers.classList.add('hidden');
    topPerformers.classList.remove('hidden');
});

lowestPerformersBtn.addEventListener('click', () => {
    lowestPerformersBtn.classList.add('toggle-btn-active');
    lowestPerformersBtn.classList.remove('toggle-btn-inactive');
    topPerformersBtn.classList.add('toggle-btn-inactive');
    topPerformersBtn.classList.remove('toggle-btn-active');

    topPerformers.classList.add('hidden');
    lowestPerformers.classList.remove('hidden');
});

// Initialize Charts
function initCharts() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#f3f4f6' : '#1f2937';
    const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

    Chart.defaults.color = textColor;
    Chart.defaults.borderColor = gridColor;

    const canvas = document.getElementById('studentChart');

    const studentCtx = canvas.getContext('2d');

        const maleCount = parseInt(canvas.getAttribute('data-male-count') || 0);
        const femaleCount = parseInt(canvas.getAttribute('data-female-count') || 0);

    if (window.studentChart && typeof window.studentChart.destroy === 'function') {
        window.studentChart.destroy();
    }
    window.studentChart = new Chart(studentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                    data: [maleCount, femaleCount],
                backgroundColor: ['#4260a6', '#e5cf86'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw + ' students';
                        }
                    }
                }
            }
        }
    });
}

// Initialize all charts on load
document.addEventListener('DOMContentLoaded', function() {
    initCharts();
});
</script>