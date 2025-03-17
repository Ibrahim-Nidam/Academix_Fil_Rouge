<script>
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
    
    
    // doghnut charts
    let studentsChart, staffChart, studentAttendanceChart, teacherAttendanceChart;
    
    function initCharts() {
        const colors = getThemeColors();
        Chart.defaults.color = colors.textColor;
        Chart.defaults.borderColor = colors.gridColor;
    
    const studentsCtx = document.getElementById('studentsChart').getContext('2d');
    studentsChart = new Chart(studentsCtx, {
        type: 'doughnut',
        data: {
        labels: ['Male', 'Female'],
        datasets: [{
            data: [60, 40],
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
    
    const staffCtx = document.getElementById('staffChart').getContext('2d');
    staffChart = new Chart(staffCtx, {
        type: 'doughnut',
        data: {
        labels: ['Male', 'Female'],
        datasets: [{
            data: [45, 55],
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
    
    // Student Attendance Chart
    const studentAttendanceCtx = document.getElementById('studentAttendanceChart').getContext('2d');
    studentAttendanceChart = new Chart(studentAttendanceCtx, {
        type: 'bar',
        data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
        datasets: [
            {
            label: 'Present',
            data: [85, 90, 80, 75, 70],
            backgroundColor: '#7a92ca',
            barPercentage: 0.9,
            categoryPercentage: 0.8,
            borderRadius: 4,
            stack: 'stack0'
            },
            {
            label: 'Absent',
            data: [15, 10, 20, 25, 30],
            backgroundColor: '#d4af37',
            barPercentage: 0.9,
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
            ticks: { callback: (value) => `${value}%` }
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
    
    // Teacher Attendance Chart
    const teacherAttendanceCtx = document.getElementById('teacherAttendanceChart').getContext('2d');
    teacherAttendanceChart = new Chart(teacherAttendanceCtx, {
        type: 'bar',
        data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
        datasets: [
            {
            label: 'Present',
            data: [95, 98, 90, 92, 85],
            backgroundColor: '#7a92ca',
            barPercentage: 0.9,
            categoryPercentage: 0.8,
            borderRadius: 4,
            stack: 'stack0'
            },
            {
            label: 'Absent',
            data: [5, 2, 10, 8, 15],
            backgroundColor: '#d4af37',
            barPercentage: 0.9,
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
            ticks: { callback: (value) => `${value}%` }
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
</script>