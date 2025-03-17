<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileInput');
    const browseBtn = document.getElementById('browse-btn');
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const removeFile = document.getElementById('remove-file');
    const dataPreview = document.getElementById('data-preview');
    const importSection = document.getElementById('import-section');
    const validateImport = document.getElementById('validate-import');
    const cancelImport = document.getElementById('cancel-import');
    const successNotification = document.getElementById('success-notification');
    
    // file selection section
    browseBtn.addEventListener('click', () => {
        fileInput.click();
    });
    
    fileInput.addEventListener('change', (e) => {
        handleFile(e.target.files[0]);
    });
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropArea.classList.add('border-primary-accent');
    }
    
    function unhighlight() {
        dropArea.classList.remove('border-primary-accent');
    }
    
    dropArea.addEventListener('drop', handleDrop, false);
    
    // helper function for human readability
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' bytes';
        else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        else return (bytes / 1048576).toFixed(1) + ' MB';
    }

    // handle chosen file 
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const file = dt.files[0];
        handleFile(file);
    }
    
    function handleFile(file) {
        if (file) {
        const validTypes = ['.xlsx', '.xls', '.csv'];
        const fileType = file.type;
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
        
        if (!validTypes.includes(fileType) && !validTypes.includes(fileExtension)) {
            alert('Please select an Excel file (.xlsx, .xls or .csv)');
            return;
        }
        
        if (file.size > 10 * 1024 * 1024) {
            alert('File size exceeds 10MB limit');
            return;
        }
        
        fileName.textContent = file.name;
        fileSize.textContent = `Size: ${formatFileSize(file.size)}`;
        fileInfo.classList.remove('hidden');
        
        dataPreview.classList.remove('hidden');
        importSection.classList.remove('hidden');
        }
    }
    
    // remove selected file
    removeFile.addEventListener('click', () => {
        fileInput.value = '';
        fileInfo.classList.add('hidden');
        dataPreview.classList.add('hidden');
        importSection.classList.add('hidden');
        successNotification.classList.add('hidden');
    });
</script>