<script>
  const uploadBtn = document.getElementById('uploadBtn');
  const uploadModal = document.getElementById('uploadModal');
  const modalOverlay = document.getElementById('modalOverlay');
  const closeModal = document.getElementById('closeModal');
  const cancelUploadBtn = document.getElementById('cancelUploadBtn');
  const uploadArea = document.getElementById('uploadArea');
  const browseBtn = document.getElementById('browseBtn');
  const fileInput = document.getElementById('fileInput');
  
  // Open Upload Modal
  uploadBtn.addEventListener('click', () => {
    uploadModal.classList.remove('hidden');
  });
  
  // Close Upload Modal
  const closeUploadModal = () => {
    uploadModal.classList.add('hidden');
  };
  
  closeModal.addEventListener('click', closeUploadModal);
  modalOverlay.addEventListener('click', closeUploadModal);
  cancelUploadBtn.addEventListener('click', closeUploadModal);
  
  browseBtn.addEventListener('click', () => {
    fileInput.click();
  });
  
  // Drag and Drop Functionality
  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('upload-area-active');
  });
  
  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('upload-area-active');
  });
  
  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('upload-area-active');
  });
  
  
</script>