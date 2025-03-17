<script>
    const eventDetails = document.getElementById('event-details');
    const mobileEventModal = document.getElementById('mobile-event-modal');
    const deleteModal = document.getElementById('delete-modal');
    const addTeacherEventBtn = document.getElementById('add-teacher-event-btn');
    const addClassEventBtn = document.getElementById('add-class-event-btn');
    const closeEventDetails = document.getElementById('close-event-details');
    const cancelEventBtn = document.getElementById('cancel-event-btn');
    const closeMobileModal = document.getElementById('close-mobile-modal');
    const mobileCancelEventBtn = document.getElementById('mobile-cancel-event-btn');
    const deleteEventBtn = document.getElementById('delete-event-btn');
    const mobileDeleteEventBtn = document.getElementById('mobile-delete-event-btn');
    const cancelDelete = document.getElementById('cancel-delete');
    const confirmDelete = document.getElementById('confirm-delete');
    const scheduleTypeSelect = document.getElementById('schedule-type');
    const mobileScheduleTypeSelect = document.getElementById('mobile-schedule-type');
    
    let currentDate = new Date();
    let selectedDate = new Date();
    let selectedEvent = null;
    let isMobileView = window.innerWidth < 1024;
    
    // FullCalendar settings
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: true,
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        height: 'auto',
        themeSystem: 'standard',
        nowIndicator: true,
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: '08:00',
            endTime: '18:00'
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '18:00:00',
        allDaySlot: false,
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: 'short'
        },
        eventClick: info => showEventDetails(info.event),
        dateClick: info => selectedDate = info.date
    });
    
    // Render the calendar
    document.addEventListener('DOMContentLoaded', function() {
        calendar.render();
        isMobileView = window.innerWidth < 1024;
    });

    // Toggle teacher/class forms
    function toggleScheduleTypeFields(formId, scheduleType) {
        const form = document.getElementById(formId);
        const prefix = formId === 'event-form' ? '' : 'mobile-';
        const teacherFields = document.getElementById(prefix + 'teacher-fields');
        const classFields = document.getElementById(prefix + 'class-fields');
        
        if (scheduleType === 'teacher') {
            teacherFields.classList.remove('hidden');
            classFields.classList.add('hidden');
            form.querySelector(`#${prefix}event-teacher`).setAttribute('required', '');
            form.querySelector(`#${prefix}event-class`) && form.querySelector(`#${prefix}event-class`).removeAttribute('required');
        } else if (scheduleType === 'class') {
            teacherFields.classList.add('hidden');
            classFields.classList.remove('hidden');
            form.querySelector(`#${prefix}event-class`).setAttribute('required', '');
            form.querySelector(`#${prefix}event-teacher`) && form.querySelector(`#${prefix}event-teacher`).removeAttribute('required');
        } else {
            teacherFields.classList.add('hidden');
            classFields.classList.add('hidden');
        }
    }

</script>