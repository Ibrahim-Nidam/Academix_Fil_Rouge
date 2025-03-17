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
    
    
</script>