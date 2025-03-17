<script>
document.addEventListener('DOMContentLoaded', function() {
    const weekDaysContainer = document.getElementById('weekDays');
    const selectedDayInfo = document.getElementById('selectedDayInfo');
    const classSelector = document.getElementById('classSelector');
    const classAttendanceSection = document.getElementById('classAttendanceSection');
    const submitAttendanceBtn = document.getElementById('submitAttendance');

    let selectedDate = new Date();
    let selectedClassId = '';
    let classes = [];
    let students = {};

    generateWeekDays();
    setupEventListeners();
    classSelector.addEventListener('change', handleClassChange);
    submitAttendanceBtn.addEventListener('click', submitAttendance);

    // week days generation
    function generateWeekDays() {
        const today = new Date();
        const weekDays = [];
        
        for (let i = 0; i < 7; i++) {
            const day = new Date(today);
            day.setDate(today.getDate() - today.getDay() + i);
            weekDays.push({
                date: day,
                dayName: day.toLocaleDateString('en-US', { weekday: 'short' }),
                dayNumber: day.getDate(),
                month: day.toLocaleDateString('en-US', { month: 'short' }),
                isToday: day.toDateString() === today.toDateString(),
                fullDate: day.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' })
            });
        }
        
        weekDaysContainer.innerHTML = '';
        weekDays.forEach((day, index) => {
            const dayElement = document.createElement('div');
            dayElement.className = `day-item ${day.isToday ? 'active' : ''}`;
            dayElement.dataset.date = day.date.toISOString();
            dayElement.innerHTML = `
                <span class="text-sm font-medium">${day.dayName}</span>
                <span class="text-xl font-bold">${day.dayNumber}</span>
                <span class="text-xs">${day.month}</span>
            `;
            
            dayElement.addEventListener('click', () => {
                selectedDate = new Date(day.date);
                
                document.querySelectorAll('.day-item').forEach(el => el.classList.remove('active'));
                dayElement.classList.add('active');
                selectedDayInfo.textContent = day.fullDate;
                
                if (selectedClassId) {
                    renderAttendanceList(selectedClassId, selectedDate);
                }
            });
            
            weekDaysContainer.appendChild(dayElement);
        });
        
        const todayData = weekDays.find(day => day.isToday);
        if (todayData) {
            selectedDayInfo.textContent = todayData.fullDate;
            selectedDate = todayData.date;
        }
    }

    function handleClassChange() {
        selectedClassId = classSelector.value;
        if (selectedClassId) {
            renderAttendanceList(selectedClassId, selectedDate);
        } else {
            classAttendanceSection.innerHTML = '';
        }
    }

    
});

</script>