<script>
    document.querySelectorAll('[data-accordion-target]').forEach(button => {
        button.addEventListener('click', () => {
        const targetId = button.getAttribute('data-accordion-target');
        const targetContent = document.getElementById(targetId);
        const arrow = button.querySelector('svg:last-child');
        
        targetContent.classList.toggle('open');
        
        if (targetContent.classList.contains('open')) {
            arrow.classList.add('rotate-180');
        } else {
            arrow.classList.remove('rotate-180');
        }
        });
    });
    
    const firstAccordion = document.querySelector('[data-accordion-target]');
    if (firstAccordion) {
        firstAccordion.click();
    }
</script>