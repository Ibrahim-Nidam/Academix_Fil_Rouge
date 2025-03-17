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
    }
</script>