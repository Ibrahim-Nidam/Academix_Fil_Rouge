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

    // Populate event form fields
    function populateEventForm(prefix, event) {
        const formId = prefix ? prefix + 'event-form' : 'event-form';
        document.getElementById(prefix + 'event-id').value = event.id;
        document.getElementById(prefix + 'event-title').value = event.title;
        document.getElementById(prefix + 'event-type').value = event.extendedProps.type;
        document.getElementById(prefix + 'schedule-type').value = event.extendedProps.scheduleType;
        toggleScheduleTypeFields(formId, event.extendedProps.scheduleType);
        if (event.extendedProps.scheduleType === 'teacher') {
            document.getElementById(prefix + 'event-teacher').value = event.extendedProps.teacher;
        } else if (event.extendedProps.scheduleType === 'class') {
            document.getElementById(prefix + 'event-class').value = event.extendedProps.class;
        }
        const startDate = event.start;
        const formattedDate = startDate.toISOString().split('T')[0];
        document.getElementById(prefix + 'event-date').value = formattedDate;
        document.getElementById(prefix + 'event-start-time').value = startDate.toTimeString().slice(0, 5);
        document.getElementById(prefix + 'event-end-time').value = event.end.toTimeString().slice(0, 5);
        document.getElementById(prefix + 'event-location').value = event.extendedProps.location;
        document.getElementById(prefix + 'event-description').value = event.extendedProps.description;
    }

    // Show add event form for both teacher and class events
    function showAddEventForm(scheduleType, titleText) {
        selectedEvent = null;
        const formattedDate = selectedDate.toISOString().split('T')[0];
        const now = new Date();
        now.setMinutes(Math.ceil(now.getMinutes() / 30) * 30);
        now.setSeconds(0);
        const formattedStartTime = now.toTimeString().slice(0, 5);
        const endTime = new Date(now);
        endTime.setHours(endTime.getHours() + 1);
        const formattedEndTime = endTime.toTimeString().slice(0, 5);
        const useDesktopForm = !isMobileView;

        if (!useDesktopForm) {
            const form = document.getElementById('mobile-event-form');
            form.reset();
            document.getElementById('mobile-event-id').value = '';
            document.getElementById('mobile-event-date').value = formattedDate;
            document.getElementById('mobile-event-start-time').value = formattedStartTime;
            document.getElementById('mobile-event-end-time').value = formattedEndTime;
            document.getElementById('mobile-form-title').textContent = titleText;
            document.getElementById('mobile-schedule-type').value = scheduleType;
            toggleScheduleTypeFields('mobile-event-form', scheduleType);
            document.querySelectorAll('#mobile-event-form [id$="-error"]').forEach(el => el.classList.add('hidden'));
            mobileEventModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            const form = document.getElementById('event-form');
            form.reset();
            document.getElementById('event-id').value = '';
            document.getElementById('event-date').value = formattedDate;
            document.getElementById('event-start-time').value = formattedStartTime;
            document.getElementById('event-end-time').value = formattedEndTime;
            document.getElementById('event-form-title').textContent = titleText;
            document.getElementById('schedule-type').value = scheduleType;
            toggleScheduleTypeFields('event-form', scheduleType);
            document.querySelectorAll('#event-form [id$="-error"]').forEach(el => el.classList.add('hidden'));
            eventDetails.classList.remove('hidden');
        }
    }

    // Show event details
    function showEventDetails(event) {
        selectedEvent = event;
        const useDesktopForm = !isMobileView;
        if (!useDesktopForm) {
            populateEventForm('mobile-', event);
            mobileEventModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            populateEventForm('', event);
            eventDetails.classList.remove('hidden');
            document.getElementById('event-form-title').textContent = 'Edit Event';
        }
    }

    // Hide event forms
    function hideEventForms() {
        eventDetails.classList.add('hidden');
        mobileEventModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Show/hide delete confirmation modal
    function showDeleteConfirmation(eventId) {
        deleteModal.classList.remove('hidden');
        confirmDelete.setAttribute('data-event-id', eventId);
        document.body.classList.add('overflow-hidden');
    }
    function hideDeleteConfirmation() {
        deleteModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    addTeacherEventBtn.addEventListener('click', () => showAddEventForm('teacher', 'Add Teacher Schedule'));
    addClassEventBtn.addEventListener('click', () => showAddEventForm('class', 'Add Class Schedule'));
    closeEventDetails.addEventListener('click', hideEventForms);
    cancelEventBtn.addEventListener('click', hideEventForms);
    closeMobileModal.addEventListener('click', hideEventForms);
    mobileCancelEventBtn.addEventListener('click', hideEventForms);

    deleteEventBtn.addEventListener('click', () => {
        const eventId = document.getElementById('event-id').value;
        showDeleteConfirmation(eventId);
    });

    mobileDeleteEventBtn.addEventListener('click', () => {
        const eventId = document.getElementById('mobile-event-id').value;
        showDeleteConfirmation(eventId);
    });

    cancelDelete.addEventListener('click', hideDeleteConfirmation);
    confirmDelete.addEventListener('click', () => {
        hideDeleteConfirmation();
        hideEventForms();
    });

    window.addEventListener('resize', () => {
        isMobileView = window.innerWidth < 1024;
    });
</script>