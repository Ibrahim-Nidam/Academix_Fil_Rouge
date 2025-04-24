<script>
document.addEventListener('DOMContentLoaded', () => {
    const addUserBtn = document.getElementById('add-user-btn');
    const editUserBtns = document.querySelectorAll('.edit-user-btn');
    const editFormContainer = document.getElementById('edit-form-container');
    const closeFormBtn = document.getElementById('close-form-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const userForm = document.getElementById('user-form');

    const userIdField = document.getElementById('user-id');
    const firstNameField = document.getElementById('first-name');
    const lastNameField = document.getElementById('last-name');
    const emailField = document.getElementById('email');
    const roleField = document.getElementById('role');
    const genderField = document.getElementById('Gender');
    const statusField = document.getElementById('status');
    const formTitle = document.getElementById('form-title');
    const classroomList = document.getElementById('classroom-badges');
    const noClassroomsMsg = document.getElementById('no-classrooms');
    
    const deleteModal = document.getElementById('delete-modal');
    const deleteModalClose = deleteModal.querySelector('.delete-modal-close');
    const confirmDelete = document.getElementById('confirm-delete');
    let currentDeleteForm = null;

    // show new user form
    addUserBtn.addEventListener('click', () => {
        userForm.reset();
        userIdField.value = '';
        formTitle.textContent = 'Add New User';
        const methodInput = userForm.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.parentNode.removeChild(methodInput);
        }
        userForm.action = '/Admin/users';
        
        classroomList.innerHTML = '';
        if (noClassroomsMsg) noClassroomsMsg.style.display = 'block';
        
        editFormContainer.classList.remove('hidden');
    });

    // show edit form 
    editUserBtns.forEach(btn => {
        btn.addEventListener('click', async () => {
            formTitle.textContent = 'Edit User';
            const userId = btn.getAttribute('data-user-id');
            userIdField.value = userId;

            const row = btn.closest('tr');
            const nameSpan = row.querySelector('span[data-first-name]');
            if (nameSpan) {
                firstNameField.value = nameSpan.getAttribute('data-first-name') || '';
                lastNameField.value = nameSpan.getAttribute('data-last-name') || '';
            }
            emailField.value = row.children[1].textContent.trim();
            roleField.value = row.children[2].textContent.trim();
            genderField.value = row.getAttribute('data-gender') || '';
            statusField.value = row.children[4].textContent.trim();

            userForm.action = `/Admin/users/${userId}`;
            if (!userForm.querySelector('input[name="_method"]')) {
                const putInput = document.createElement('input');
                putInput.type = 'hidden';
                putInput.name = '_method';
                putInput.value = 'PUT';
                userForm.appendChild(putInput);
            }

            toggleTeacherFields();

            if (roleField.value === 'Teacher') {
                try {
                    const response = await fetch(`/Admin/users/${userId}/assignments`);
                    const data = await response.json();

                    if (classroomList && data.classrooms) {
                        classroomList.innerHTML = '';
                        
                        if (data.classrooms.length > 0) {
                            if (noClassroomsMsg) noClassroomsMsg.style.display = 'none';
                            
                            data.classrooms.forEach(classroom => {
                                const badge = document.createElement('span');
                                badge.className = 'badge badge-blue';
                                badge.textContent = classroom.name;
                                classroomList.appendChild(badge);
                            });
                        } else {
                            if (noClassroomsMsg) noClassroomsMsg.style.display = 'block';
                        }
                    }

                    if (data.subjects && data.subjects.length > 0) {
                        document.getElementById('subject').value = data.subjects[0].subject_id || '';
                    }
                } catch (error) {
                    console.error('Error fetching assignments:', error);
                }
            }

            editFormContainer.classList.remove('hidden');
        });
    });

    // Close/Cancel buttons for the edit user form
    [closeFormBtn, cancelBtn].forEach(el => {
        el.addEventListener('click', () => {
            editFormContainer.classList.add('hidden');
            userForm.reset();
        });
    });

    // Show delete confirmation modal
    const deleteButtons = document.querySelectorAll('.delete-user-btn');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentDeleteForm = btn.closest('form');
            deleteModal.classList.remove('hidden');
        });
    });
    deleteModalClose.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        currentDeleteForm = null;
    });
    confirmDelete.addEventListener('click', () => {
        if (currentDeleteForm) {
            currentDeleteForm.submit();
        }
    });

    function toggleTeacherFields() {
        const role = roleField.value;
        const teacherFields = document.querySelectorAll('.teacher-only');
        teacherFields.forEach(field => {
            field.classList.toggle('hidden', role !== 'Teacher');
        });
    }

    roleField.addEventListener('change', toggleTeacherFields);
    toggleTeacherFields();
});
</script>