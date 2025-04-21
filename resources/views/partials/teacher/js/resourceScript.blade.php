<script>
document.addEventListener('DOMContentLoaded', function() {
  const uploadModal = document.getElementById('uploadModal');
  const resourceModal = document.getElementById('resourceModal');
  const modalOverlays = document.querySelectorAll('.modal-overlay');
  
  const uploadForm = document.getElementById('uploadForm');
  const fileInput = document.getElementById('fileInput');
  const browseBtn = document.getElementById('browseBtn');
  const progressBar = document.getElementById('progressBar');
  const uploadStatus = document.getElementById('uploadStatus');
  const resourceIdInput = document.getElementById('resourceId');
  
  // Modal toggle functions
  function openUploadModal() {
    uploadForm.reset();
    resourceIdInput.value = '';
    document.getElementById('uploadIdle').style.display = 'flex';
    document.getElementById('uploadProgress').style.display = 'none';
    document.querySelector('#uploadModal h2').textContent = 'Upload New Resource';
    document.querySelector('#uploadModal button[type="submit"]').textContent = 'Upload';
    uploadModal.classList.remove('hidden');
  }
  
  function closeAllModals() {
    uploadModal.classList.add('hidden');
    resourceModal.classList.add('hidden');
  }

  // Event listeners for modals
  document.getElementById('uploadBtn').addEventListener('click', openUploadModal);
  document.getElementById('closeModal').addEventListener('click', closeAllModals);
  document.getElementById('cancelUploadBtn').addEventListener('click', closeAllModals);
  document.getElementById('closeResourceModal').addEventListener('click', closeAllModals);
  modalOverlays.forEach(overlay => overlay.addEventListener('click', closeAllModals));
  
  // File upload handling
  browseBtn.addEventListener('click', () => fileInput.click());

  uploadForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(uploadForm);
    const resourceId = resourceIdInput.value;

    if (resourceId) {
      formData.append('_method', 'PUT');
    }

    try {
      const response = await fetch(`/Teacher/resource${resourceId ? `/${resourceId}` : ''}`, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });

      if (!response.ok) throw new Error('Request failed');
      
      closeAllModals();
      window.location.reload();
    } catch (error) {
      console.error('Error:', error);
      uploadStatus.textContent = 'An error occurred. Please try again.';
      progressBar.style.width = '0%';
    }
  });
    });
  });
  
  // Close Resource Modal
  const closeResourceModalFunc = () => {
    resourceModal.classList.add('hidden');
  };
  
  closeResourceModal.addEventListener('click', closeResourceModalFunc);
  resourceModalOverlay.addEventListener('click', closeResourceModalFunc);
</script>