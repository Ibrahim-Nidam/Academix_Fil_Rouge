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

</script>