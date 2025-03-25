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
    const validateUpload = document.getElementById('validate-upload');
    const cancelUpload = document.getElementById('cancel-upload');
    const uploadForm = document.getElementById('uploadForm');
    const hiddenUserType = document.getElementById('hidden-user-type');
    
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
        e.preventDefault();
        e.stopPropagation();
        const dt = e.dataTransfer;
        if (dt && dt.files && dt.files.length > 0) {
            const file = dt.files[0];
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            handleFile(file);
        } else {
            console.warn('No files found in dataTransfer.');
        }
    }
    
    function handleFile(file) {
        if (file) {
        const validTypes = ['.xlsx', '.xls', '.csv'];
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

        if (!validTypes.includes(fileExtension)) {
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
        importSection.classList.remove('hidden');
        }
    }

    // remove selected file
    removeFile.addEventListener('click', () => {
        fileInput.value = '';
        fileInfo.classList.add('hidden');
        dataPreview.classList.add('hidden');
        importSection.classList.add('hidden');
    });

    // validated file
    validateUpload.addEventListener('click', () => {
        const selectedUserTypeElem = document.querySelector('input[name="user_type"]:checked');
        if (selectedUserTypeElem) {
            hiddenUserType.value = selectedUserTypeElem.value;
        }
        if (fileInput.files.length === 0) {
            alert('Please select a file first');
            return;
        }
        uploadForm.submit();
    });

    // Cancel file upload process
    cancelUpload.addEventListener('click', () => {
        fileInput.value = '';
        fileInfo.classList.add('hidden');
        importSection.classList.add('hidden');
    });

    // checkboxes variables in the preview table
    const selectAll = document.getElementById('select-all');
    const deselectAll = document.getElementById('deselect-all');
    const checkboxAll = document.getElementById('checkbox-all');

    // bulk selection 
    if (selectAll) {
        selectAll.addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = true);
            if (checkboxAll) checkboxAll.checked = true;
        });
    }
    
    // bulk deselection 
    if (deselectAll) {
        deselectAll.addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            if (checkboxAll) checkboxAll.checked = false;
        });
    }

    if (checkboxAll) {
        checkboxAll.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    }

    // Cancel import preview
    const cancelImport = document.getElementById('cancel-import');
    if (cancelImport) {
        cancelImport.addEventListener('click', () => {
            dataPreview.classList.add('hidden');
    });
    }

    if (window.previewData && Array.isArray(window.previewData)) {
        dataPreview.classList.remove('hidden');

        const tbody = document.getElementById('import-data-body');
        tbody.innerHTML = ''; 

        const allRows = window.previewData.map((user, index) => {
            return `
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-primary-light/10 dark:hover:bg-primary-dark/20 transition-colors">
                <td class="px-4 py-3 whitespace-nowrap">
                <input type="checkbox" name="selected_users[]" value="${index}" checked class="rounded border-primary-blue/70 text-primary-blue focus:ring-primary-blue/30 dark:border-primary-present dark:bg-primary-dark dark:text-primary-present">
                <input type="hidden" name="users[${index}][first_name]" value="${user.first_name}">
                <input type="hidden" name="users[${index}][last_name]" value="${user.last_name}">
                <input type="hidden" name="users[${index}][gender]" value="${user.gender}">
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                <input type="text" name="users[${index}][first_name]" value="${user.first_name}" class="w-full rounded-md border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-primary-blue focus:ring focus:ring-primary-blue/20 dark:border-gray-600 dark:bg-primary-dark dark:text-primary-text-dark dark:focus:border-primary-present">
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                <input type="text" name="users[${index}][last_name]" value="${user.last_name}" class="w-full rounded-md border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-primary-blue focus:ring focus:ring-primary-blue/20 dark:border-gray-600 dark:bg-primary-dark dark:text-primary-text-dark dark:focus:border-primary-present">
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                <select name="users[${index}][gender]" class="w-full rounded-md border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-primary-blue focus:ring focus:ring-primary-blue/20 dark:border-gray-600 dark:bg-primary-dark dark:text-primary-text-dark dark:focus:border-primary-present">
                    <option value="Male" ${user.gender === 'Male' ? 'selected' : ''}>Male</option>
                    <option value="Female" ${user.gender === 'Female' ? 'selected' : ''}>Female</option>
                </select>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                <input type="text" name="users[${index}][username]" value="${user.username || ''}" class="w-full rounded-md border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-primary-blue focus:ring focus:ring-primary-blue/20 dark:border-gray-600 dark:bg-primary-dark dark:text-primary-text-dark dark:focus:border-primary-present">
                </td>
            </tr>
            `;
        });
    }
</script>