<script>
    const classCards = document.querySelectorAll('.class-card');
    
    classCards.forEach(card => {
        card.addEventListener('click', () => {
            classCards.forEach(c => c.classList.remove('active'));
            
            card.classList.add('active');
            const className = card.querySelector('h3').textContent;
            const subjectName = card.querySelector('p').textContent;
            
            document.querySelector('#gradingSection h2').textContent = className;
            document.querySelector('#gradingSection p').textContent = subjectName;
        });
    });
    
    const addExamBtn = document.getElementById('addExamBtn');
    const addExamModal = document.getElementById('addExamModal');
    const closeExamModalBtn = document.getElementById('closeExamModal');
    const cancelExamBtn = document.getElementById('cancelExamBtn');
    const modalOverlay = document.getElementById('modalOverlay');
    const addExamForm = document.getElementById('addExamForm');
    
    function openExamModal() {
    addExamModal.classList.remove('hidden');
    }
    
    function closeExamModal() {
    addExamModal.classList.add('hidden');
    }
    
    addExamBtn.addEventListener('click', openExamModal);
    closeExamModalBtn.addEventListener('click', closeExamModal);
    cancelExamBtn.addEventListener('click', closeExamModal);
    modalOverlay.addEventListener('click', closeExamModal);
    
    </script>