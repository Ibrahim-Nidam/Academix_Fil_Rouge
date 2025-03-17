<script>
    const editFormContainer = document.getElementById('edit-form-container');
    const mobileEditModal = document.getElementById('mobile-edit-modal');
    const deleteModal = document.getElementById('delete-modal');
    const successToast = document.getElementById('success-toast');
    
    const editButtons = document.querySelectorAll('.edit-user-btn');
    const deleteButtons = document.querySelectorAll('.delete-user-btn');
    const addUserBtn = document.getElementById('add-user-btn');
    const closeFormBtn = document.getElementById('close-form-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const closeMobileModal = document.getElementById('close-mobile-modal');
    const mobileCancelBtn = document.getElementById('mobile-cancel-btn');
    const cancelDelete = document.getElementById('cancel-delete');
    const confirmDelete = document.getElementById('confirm-delete');
    
    const roleSelect = document.getElementById('role');
    const mobileRoleSelect = document.getElementById('mobile-role');
    const teacherFields = document.getElementById('teacher-fields');
    const studentFields = document.getElementById('student-fields');
    const mobileTeacherFields = document.getElementById('mobile-teacher-fields');
    const mobileStudentFields = document.getElementById('mobile-student-fields');
    
    // Show edit form
    function showEditForm(userId) {
        const user = users.find(u => u.id === parseInt(userId));
        if (!user) return;
        const prefix = getPrefix();
        populateUserForm(prefix, user);
        if (prefix === 'mobile-') {
        mobileEditModal.classList.remove('hidden');
        } else {
        editFormContainer.classList.remove('hidden');
        document.getElementById('form-title').textContent = 'Edit User';
        }
        document.body.classList.add('overflow-hidden');
    }
    
    // Show add user form
    function showAddUserForm() {
        const prefix = getPrefix();
        resetUserForm(prefix, 'Add User');
        if (prefix === 'mobile-') {
        mobileEditModal.classList.remove('hidden');
        } else {
        editFormContainer.classList.remove('hidden');
        }
        document.body.classList.add('overflow-hidden');
    }
    
    // Hide forms
    function hideEditForms() {
        editFormContainer.classList.add('hidden');
        mobileEditModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Show delete confirmation modal
    function showDeleteConfirmation(userId) {
        deleteModal.classList.remove('hidden');
        confirmDelete.setAttribute('data-user-id', userId);
        document.body.classList.add('overflow-hidden');
    }
    
    // Hide delete confirmation modal
    function hideDeleteConfirmation() {
        deleteModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Show success toast
    function showSuccessToast(message) {
        const toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = message;
        successToast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => {
        successToast.classList.add('translate-y-20', 'opacity-0');
        }, 3000);
    }
    
    // Edit button clicks
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        showEditForm(userId);
        });
    });
    
    // Delete button clicks
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        showDeleteConfirmation(userId);
        });
    });
    
    // Add user button
    addUserBtn.addEventListener('click', showAddUserForm);
    
    // Close/cancel form buttons
    closeFormBtn.addEventListener('click', hideEditForms);
    cancelBtn.addEventListener('click', hideEditForms);
    closeMobileModal.addEventListener('click', hideEditForms);
    mobileCancelBtn.addEventListener('click', hideEditForms);
    
    // Delete modal buttons
    cancelDelete.addEventListener('click', hideDeleteConfirmation);
    confirmDelete.addEventListener('click', () => {
        const userId = confirmDelete.getAttribute('data-user-id');
        hideDeleteConfirmation();
        showSuccessToast('User deleted successfully!');
    });
    
    // Form submissions
    document.getElementById('user-form').addEventListener('submit', e => {
        e.preventDefault();
        hideEditForms();
        showSuccessToast('User updated successfully!');
    });
    document.getElementById('mobile-user-form').addEventListener('submit', e => {
        e.preventDefault();
        hideEditForms();
        showSuccessToast('User updated successfully!');
    });
    
    // Role change handlers
    roleSelect.addEventListener('change', e => {
        if (e.target.value === 'teacher') {
        teacherFields.classList.remove('hidden');
        studentFields.classList.add('hidden');
        } else {
        teacherFields.classList.add('hidden');
        studentFields.classList.remove('hidden');
        }
    });
    mobileRoleSelect.addEventListener('change', e => {
        if (e.target.value === 'teacher') {
        mobileTeacherFields.classList.remove('hidden');
        mobileStudentFields.classList.add('hidden');
        } else {
        mobileTeacherFields.classList.add('hidden');
        mobileStudentFields.classList.remove('hidden');
        }
    });
    
    function getPrefix() {
        return window.innerWidth < 1024 ? 'mobile-' : '';
    }
    
    //Populate user form fields for the given prefix
    function populateUserForm(prefix, user) {
        document.getElementById(prefix + 'user-id').value = user.id;
        document.getElementById(prefix + 'first-name').value = user.firstName;
        document.getElementById(prefix + 'last-name').value = user.lastName;
        document.getElementById(prefix + 'email').value = user.email;
        document.getElementById(prefix + 'role').value = user.role;
        document.getElementById(prefix + 'status').value = user.status;
        
        if (user.role === 'teacher') {
        document.getElementById(prefix + 'department').value = user.department;
        if (prefix === 'mobile-') {
            mobileTeacherFields.classList.remove('hidden');
            mobileStudentFields.classList.add('hidden');
        } else {
            teacherFields.classList.remove('hidden');
            studentFields.classList.add('hidden');
        }
        } else {
        document.getElementById(prefix + 'grade').value = user.grade;
        if (prefix === 'mobile-') {
            mobileTeacherFields.classList.add('hidden');
            mobileStudentFields.classList.remove('hidden');
        } else {
            teacherFields.classList.add('hidden');
            studentFields.classList.remove('hidden');
        }
        }
    }
    
    // Reset the user form for adding a new user
    function resetUserForm(prefix, titleText) {
        document.getElementById(prefix + 'user-form').reset();
        document.getElementById(prefix + 'user-id').value = '';
        document.getElementById(prefix + 'form-title').textContent = titleText;
        if (prefix === 'mobile-') {
        mobileTeacherFields.classList.remove('hidden');
        mobileStudentFields.classList.add('hidden');
        } else {
        teacherFields.classList.remove('hidden');
        studentFields.classList.add('hidden');
        }
    }
    
    
</script>