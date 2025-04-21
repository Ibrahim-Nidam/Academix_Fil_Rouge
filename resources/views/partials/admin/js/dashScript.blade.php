<script>
document.addEventListener('DOMContentLoaded', function() {
// header date
const now = new Date();
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);

// report generation button
const generateReportBtn = document.getElementById('generate-report');
const successNotification = document.getElementById('success-notification');

generateReportBtn.addEventListener('click', () => {
    generateReportBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Generating...';
    generateReportBtn.disabled = true;

    setTimeout(() => {
        generateReportBtn.innerHTML = '<i class="fas fa-file-alt mr-2"></i> Generate Report';
        generateReportBtn.disabled = false;
        
        successNotification.classList.remove('hidden');
        
        setTimeout(() => {
            successNotification.classList.add('hidden');
        }, 5000);
    }, 2000);
});

// Get theme colors
function getThemeColors() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    return {
        textColor: isDarkMode ? '#e5e7eb' : '#374151',
        gridColor: isDarkMode ? '#374151' : '#e5e7eb'
    };
}

// Initialize charts
function initCharts() {
    const colors = getThemeColors();
    Chart.defaults.color = colors.textColor;
    Chart.defaults.borderColor = colors.gridColor;

    // Students Chart
    const studentsCtx = document.getElementById('studentsChart').getContext('2d');
    const studentsChart = new Chart(studentsCtx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [
                    parseInt(document.getElementById('male-students-count').value),
                    parseInt(document.getElementById('female-students-count').value)
                ],
                backgroundColor: ['#4260a6', '#e5cf86'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // Staff Chart
    const staffCtx = document.getElementById('staffChart').getContext('2d');
    const staffChart = new Chart(staffCtx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [
                    parseInt(document.getElementById('male-staff-count').value),
                    parseInt(document.getElementById('female-staff-count').value)
                ],
                backgroundColor: ['#4260a6', '#e5cf86'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // Get attendance data from hidden inputs
    const presentData = JSON.parse(document.getElementById('attendance-present-data').value);
    const absentData = JSON.parse(document.getElementById('attendance-absent-data').value);
    
    // Student Attendance Chart
    const studentAttendanceCtx = document.getElementById('studentAttendanceChart').getContext('2d');
    const studentAttendanceChart = new Chart(studentAttendanceCtx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [
                {
                    label: 'Present',
                    data: presentData,
                    backgroundColor: '#7a92ca',
                    barPercentage: 0.6,
                    categoryPercentage: 0.8,
                    borderRadius: 4,
                    stack: 'stack0'
                },
                {
                    label: 'Absent',
                    data: absentData,
                    backgroundColor: '#d4af37',
                    barPercentage: 0.6,
                    categoryPercentage: 0.8,
                    borderRadius: 4,
                    stack: 'stack0'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                    grid: { display: false }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: (value) => `${value}%`,
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (context) => `${context.dataset.label}: ${context.raw}%`
                    }
                }
            }
        }
    });
}

initCharts();

document.addEventListener('themeChanged', function() {
    initCharts();
});
});
</script>