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

  // Resource details handling
  document.querySelectorAll('.resource-card').forEach(card => {
    card.addEventListener('click', async function() {
      const resourceId = this.dataset.resourceId;
      try {
        const response = await fetch(`/Teacher/resource/${resourceId}`);
        const resource = await response.json();
        
        console.log("Resource data:", resource);
        
        const modal = document.getElementById('resourceModal');
        const titleElement = modal.querySelector('#modalResourceTitle');
        const dateElement = modal.querySelector('#resourceDate');
        const typeElement = modal.querySelector('#resourceType');
        const sizeElement = modal.querySelector('#resourceSize');
        const uploadDateElement = modal.querySelector('#resourceUploadDate');
        const downloadsElement = modal.querySelector('#resourceDownloads');
        const descriptionElement = modal.querySelector('#resourceDescription');
        const tagsContainer = modal.querySelector('#resourceTags');
        
        if (titleElement) titleElement.textContent = resource.title;
        if (dateElement) dateElement.textContent = `Added ${new Date(resource.created_at).toLocaleDateString()}`;
        if (typeElement) typeElement.textContent = resource.file_type;
        if (sizeElement) sizeElement.textContent = resource.file_size;
        if (uploadDateElement) uploadDateElement.textContent = new Date(resource.created_at).toLocaleDateString();
        if (downloadsElement) downloadsElement.textContent = resource.downloads;
        if (descriptionElement) descriptionElement.textContent = resource.description || 'No description available';
        
        if (tagsContainer && resource.tags && Array.isArray(resource.tags)) {
          tagsContainer.innerHTML = resource.tags.map(tag => `
            <span class="text-xs bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-md">${tag.tag_name}</span>
          `).join('');
        } else if (tagsContainer) {
          tagsContainer.innerHTML = '<span class="text-xs text-gray-500">No tags</span>';
        }
        
        modal.dataset.resourceId = resourceId;
        
        modal.classList.remove('hidden');
      } catch (error) {
        console.error('Error fetching resource:', error);
      }
    });
  });
  
  // Edit resource handling
  document.getElementById('editResourceBtn').addEventListener('click', async function() {
    const resourceId = resourceModal.dataset.resourceId;
    try {
      const response = await fetch(`/Teacher/resource/${resourceId}`);
      const resource = await response.json();

      resourceIdInput.value = resource.id;
      document.getElementById('inputResourceTitle').value = resource.title;
      document.getElementById('resourceDescription').value = resource.description;
      document.getElementById('resourceTags').value = resource.tags.map(tag => tag.tag_name).join(', ');

      document.getElementById('uploadIdle').style.display = 'none';
      document.getElementById('uploadProgress').style.display = 'none';
      document.querySelector('#uploadModal h2').textContent = 'Edit Resource';
      document.querySelector('#uploadModal button[type="submit"]').textContent = 'Save Changes';
      uploadModal.classList.remove('hidden');
    resourceModal.classList.add('hidden');
    } catch (error) {
      console.error('Error fetching resource:', error);
    }
  });
</script>