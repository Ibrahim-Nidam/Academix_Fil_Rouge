<script>
document.addEventListener('DOMContentLoaded', function() {
    const weekDaysContainer = document.getElementById('weekDays');
    const classSelector = document.getElementById('classSelector');
    const classAttendanceSection = document.getElementById('classAttendanceSection');
    const submitAttendanceBtn = document.getElementById('submitAttendance');
    const toast = document.getElementById('toast');

    let selectedDate = new Date();
    let selectedClassId = '';
    let classes = [];
    let students = {};
    let attendanceRecords = {};

    generateWeekDays();
    setupEventListeners();

    function setupEventListeners() {
        classSelector.addEventListener('change', handleClassChange);
        submitAttendanceBtn.addEventListener('click', submitAttendance);
    }

    // week days generation
    function generateWeekDays() {
        const today = new Date();
        const weekDays = [];
        
        for (let i = 1; i < 7; i++) {
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
                
                const dayOfWeek = day.date.toLocaleDateString('en-US', { weekday: 'long' });
                fetchClassesForDay(dayOfWeek);
            });
            
            weekDaysContainer.appendChild(dayElement);
        });
        
        const todayData = weekDays.find(day => day.isToday);
        if (todayData) {
            selectedDate = todayData.date;
            
            const todayOfWeek = today.toLocaleDateString('en-US', { weekday: 'long' });
            fetchClassesForDay(todayOfWeek);
        }
    }

    // Fetch classes for a specific day
    function fetchClassesForDay(dayOfWeek) {
        fetch(`/Teacher/attendance/classes/${dayOfWeek}`)
            .then(response => response.json())
            .then(data => {
                classes = data;
                populateClassSelector(classes);
                
                if (selectedClassId) {
                    const stillAvailable = classes.some(c => c.classroom_id == selectedClassId);
                    if (stillAvailable) {
                        classSelector.value = selectedClassId;
                        fetchStudentsForClass(selectedClassId);
                    } else {
                        classAttendanceSection.innerHTML = '';
                    }
                }
            })
            .catch(error => console.error('Error fetching classes:', error));
    }

    // Populate the class selector dropdown
    function populateClassSelector(classes) {
        classSelector.innerHTML = '<option value="">Select a class...</option>';
        
        classes.forEach(classItem => {
            const option = document.createElement('option');
            option.value = classItem.classroom_id;
            
            const startTime = formatTime(classItem.start_time);
            const endTime = formatTime(classItem.end_time);
            
            option.textContent = `${classItem.classroom.name} (${startTime} - ${endTime})`;
            classSelector.appendChild(option);
        });
    }

    // Handle class selection change
    function handleClassChange() {
        selectedClassId = classSelector.value;
        if (selectedClassId) {
            fetchStudentsForClass(selectedClassId);
        } else {
            classAttendanceSection.innerHTML = '';
        }
    }

    // Fetch students for the selected class
    function fetchStudentsForClass(classId) {
        fetch(`/Teacher/attendance/students/${classId}`)
            .then(response => response.json())
            .then(data => {
                students[classId] = data;
                const dateKey = formatDateForAPI(selectedDate);
                const recordKey = `${classId}_${dateKey}`;
                
                if (!attendanceRecords[recordKey]) {
                    attendanceRecords[recordKey] = {};
                    
                    students[classId].forEach(student => {
                        attendanceRecords[recordKey][student.user_id] = 'present';
                    });
                }
                
                renderAttendanceList(classId, selectedDate);
            })
            .catch(error => console.error('Error fetching students:', error));
    }

    // Render the attendance list for a class
    function renderAttendanceList(classId, date) {
        const selectedClass = classes.find(c => c.classroom_id == classId);
        const dateKey = formatDateForAPI(date);
        const recordKey = `${classId}_${dateKey}`;
        
        if (!selectedClass || !students[classId]) {
            return;
        }
        
        const classCard = document.createElement('div');
        classCard.className = 'class-card';
        
        const classHeader = document.createElement('div');
        classHeader.className = 'class-header';
        
        let presentCount = 0;
        let absentCount = 0;
        
        students[classId].forEach(student => {
            const status = attendanceRecords[recordKey][student.user_id] || 'present';
            if (status === 'present') {
                presentCount++;
            } else {
                absentCount++;
            }
        });
        
        classHeader.innerHTML = `
            <div>
                <h3 class="text-lg font-semibold">${selectedClass.classroom.name}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">${formatTime(selectedClass.start_time)} - ${formatTime(selectedClass.end_time)}</p>
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
            
            const currentStatus = attendanceRecords[recordKey][student.user_id] || 'present';
            const isAbsent = currentStatus === 'absent';
            
            studentRow.innerHTML = `
                <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center mr-3">
                        <span class="font-medium">${student.user.first_name.charAt(0)}</span>
                    </div>
                    <div>
                        <div class="font-medium">${student.user.first_name} ${student.user.last_name}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">ID: ${student.user_id}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium attendance-label ${isAbsent ? 'text-absent' : 'text-green-500'}">
                        ${isAbsent ? 'Absent' : 'Present'}
                    </span>
                    <div class="attendance-toggle ${isAbsent ? 'absent' : ''}" 
                            data-student-id="${student.user_id}" 
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

    // showToast function
    function showToast(message, type = 'success') {
        if (toast) {
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = toast.querySelector('svg');
            
            if (toastMessage) {
                toastMessage.textContent = message;
            }
            
            toast.classList.remove('hidden');
            
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                toast.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            }, 10);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-20px)';
                
                setTimeout(() => {
                    toast.classList.add('hidden');
                    toast.style.transition = '';
                }, 300);
            }, 3000);
        }
    }

    // submit attendance
    function submitAttendance() {
        if (!selectedClassId || !students[selectedClassId]) {
            showToast("Please select a class first");
            return;
        }
        
        const dateKey = formatDateForAPI(selectedDate);
        const recordKey = `${selectedClassId}_${dateKey}`;
        
        const records = [];
        
        students[selectedClassId].forEach(student => {
            records.push({
                classroom_id: parseInt(selectedClassId),
                student_id: student.user_id,
                status: attendanceRecords[recordKey][student.user_id] || 'present',
                date: dateKey
            });
        });
        
        showToast("Submitting attendance...");
        
        fetch('/Teacher/attendance/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ records: records })
        })
        .then(response => response.json())
        .then(data => {
            const selectedClass = classes.find(c => c.classroom_id == selectedClassId);
            const className = selectedClass ? selectedClass.classroom.name : 'Class';
            
            showToast(data.message || `${className} attendance submitted successfully`);
        })
        .catch(error => {
            console.error('Error submitting attendance:', error);
            showToast("Failed to submit attendance");
        });
    }

    // Helper function to format time
    function formatTime(timeString) {
        const [hours, minutes] = timeString.split(':');
        const hour = parseInt(hours);
        const period = hour >= 12 ? 'PM' : 'AM';
        const formattedHour = hour % 12 || 12;
        return `${formattedHour}:${minutes} ${period}`;
    }

    // Helper function to format date for API
    function formatDateForAPI(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
});
</script>