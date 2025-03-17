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

    // render students list
    function renderAttendanceList(classId, date) {
        const selectedClass = classes.find(c => c.id === classId);
        const dateKey = date.toISOString().split('T')[0];
        const recordKey = `${classId}_${dateKey}`;
        
        const classCard = document.createElement('div');
        classCard.className = 'class-card';
        
        const classHeader = document.createElement('div');
        classHeader.className = 'class-header';
        
        let presentCount = 0;
        let absentCount = 0;
        
        Object.values(attendanceRecords[recordKey]).forEach(status => {
            if (status === 'present') {
                presentCount++;
            } else {
                absentCount++;
            }
        });
        
        classHeader.innerHTML = `
            <div>
                <h3 class="text-lg font-semibold">${selectedClass.name}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">${selectedClass.time}</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium">${students[classId].length} Students</span>
                <span class="attendance-status attendance-status-present">
                    ${presentCount} Present
                </span>
                <span class="attendance-status attendance-status-absent ${absentCount === 0 ? 'hidden' : ''}">
                    ${absentCount} Absent
                </span>
            </div>
        `;
        
        classCard.appendChild(classHeader);
        
        const studentList = document.createElement('div');
        studentList.className = 'student-list';
        
        students[classId].forEach(student => {
            const studentRow = document.createElement('div');
            studentRow.className = 'student-row';
            
            const currentStatus = attendanceRecords[recordKey][student.id] || 'present';
            const isAbsent = currentStatus === 'absent';
            
            studentRow.innerHTML = `
                <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center mr-3">
                        <span class="font-medium">${student.name.charAt(0)}</span>
                    </div>
                    <div>
                        <div class="font-medium">${student.name}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">ID: ${student.id}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium attendance-label ${isAbsent ? 'text-absent' : 'text-green-500'}">
                        ${isAbsent ? 'Absent' : 'Present'}
                    </span>
                    <div class="attendance-toggle ${isAbsent ? 'absent' : ''}" 
                            data-student-id="${student.id}" 
                            data-record-key="${recordKey}">
                        <span class="attendance-toggle-thumb"></span>
                    </div>
                </div>
            `;
            
            studentList.appendChild(studentRow);
        });
        
        classCard.appendChild(studentList);
        classAttendanceSection.innerHTML = '';
        classAttendanceSection.appendChild(classCard);
        
        document.querySelectorAll('.attendance-toggle').forEach(toggle => {
            toggle.addEventListener('click', handleAttendanceToggle);
        });
    }

    // attendance toggle
    function handleAttendanceToggle() {
        const studentId = this.dataset.studentId;
        const recordKey = this.dataset.recordKey;
        
        this.classList.toggle('absent');
        
        const label = this.previousElementSibling;
        const isAbsent = this.classList.contains('absent');
        
        if (isAbsent) {
            label.textContent = 'Absent';
            label.classList.add('text-absent');
            label.classList.remove('text-green-500');
            attendanceRecords[recordKey][studentId] = 'absent';
        } else {
            label.textContent = 'Present';
            label.classList.remove('text-absent');
            label.classList.add('text-green-500');
            attendanceRecords[recordKey][studentId] = 'present';
        }
        
        updateAttendanceCounts(recordKey);
    }

    // attendance counter
    function updateAttendanceCounts(recordKey) {
        let presentCount = 0;
        let absentCount = 0;
        
        Object.values(attendanceRecords[recordKey]).forEach(status => {
            if (status === 'present') {
                presentCount++;
            } else {
                absentCount++;
            }
        });

        const presentCountEl = document.querySelector('.attendance-status-present');
        const absentCountEl = document.querySelector('.attendance-status-absent');
        
        if (presentCountEl) {
            presentCountEl.textContent = `${presentCount} Present`;
        }
        
        if (absentCountEl) {
            absentCountEl.textContent = `${absentCount} Absent`;
            
            if (absentCount > 0) {
                absentCountEl.classList.remove('hidden');
            } else {
                absentCountEl.classList.add('hidden');
            }
        }
    }
});

</script>