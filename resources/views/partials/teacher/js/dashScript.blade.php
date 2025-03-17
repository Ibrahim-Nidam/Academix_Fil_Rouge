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


</script>