<script>
    const teacherCards = document.querySelectorAll('.teacher-card');
    const teacherResources = document.querySelectorAll('.teacher-resources');
  
    teacherCards.forEach(card => {
      card.addEventListener('click', () => {
        teacherCards.forEach(c => c.classList.remove('teacher-card-active'));
        
        card.classList.add('teacher-card-active');
        
        teacherResources.forEach(section => section.classList.add('hidden'));
        
        const teacherId = card.getAttribute('data-teacher');
        const resourceSection = document.getElementById(`${teacherId}-resources`);
        if (resourceSection) {
          resourceSection.classList.remove('hidden');
        }
      });
    });
</script>