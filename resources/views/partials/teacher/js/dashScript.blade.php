<script>
const dateElement = document.getElementById('currentDate');
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
const today = new Date();
const dateString = today.toLocaleDateString('en-US', options);
dateElement.textContent = `${dateString} — Here's your daily overview`;

const topPerformersBtn = document.getElementById('topPerformersBtn');
const lowestPerformersBtn = document.getElementById('lowestPerformersBtn');
const topPerformers = document.getElementById('topPerformers');
const lowestPerformers = document.getElementById('lowestPerformers');

topPerformersBtn.addEventListener('click', () => {
    topPerformersBtn.classList.add('toggle-btn-active');
    topPerformersBtn.classList.remove('toggle-btn-inactive');
    lowestPerformersBtn.classList.add('toggle-btn-inactive');
    lowestPerformersBtn.classList.remove('toggle-btn-active');

    lowestPerformers.classList.add('hidden');
    topPerformers.classList.remove('hidden');
});

lowestPerformersBtn.addEventListener('click', () => {
    lowestPerformersBtn.classList.add('toggle-btn-active');
    lowestPerformersBtn.classList.remove('toggle-btn-inactive');
    topPerformersBtn.classList.add('toggle-btn-inactive');
    topPerformersBtn.classList.remove('toggle-btn-active');

    topPerformers.classList.add('hidden');
    lowestPerformers.classList.remove('hidden');
});


</script>