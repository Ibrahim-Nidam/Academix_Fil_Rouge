<script>
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
        editFormContainer.classList.remove('hidden');
    });

    // show edit form 
    editUserBtns.forEach(btn => {
        btn.addEventListener('click', () => {
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
            editFormContainer.classList.remove('hidden');
        });
    });

</script>