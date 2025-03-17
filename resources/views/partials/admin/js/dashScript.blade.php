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
</script>