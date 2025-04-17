<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventDetails = document.getElementById('event-details');
    const addScheduleBtn = document.getElementById('add-schedule-btn');
    const closeEventDetails = document.getElementById('close-event-details');
    const cancelEventBtn = document.getElementById('cancel-event-btn');
    const deleteEventBtn = document.getElementById('delete-event-btn');
    const deleteModal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');
    const deleteModalCloseButtons = document.querySelectorAll('.delete-modal-close');

    let selectedDate = new Date();
    let selectedEvent = null;

    // FullCalendar setup
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '/Admin/planning/events',
        editable: false,
        selectable: true,
        dayMaxEvents: true,
        height: 'auto',
        themeSystem: 'standard',
        nowIndicator: true,
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5, 6],
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
        dateClick: info => {
            selectedDate = info.date;
            resetForm();
            eventDetails.classList.remove('hidden');
        }
    });

    calendar.render();

    function resetForm() {
        const form = document.getElementById('event-form');
        form.reset();
        document.getElementById('event-id').value = '';

        const now = new Date();
        now.setMinutes(Math.ceil(now.getMinutes() / 30) * 30);
        now.setSeconds(0);
        const startTime = now.toTimeString().slice(0, 5);
        const endTime = new Date(now);
        endTime.setHours(endTime.getHours() + 1);
        const endFormatted = endTime.toTimeString().slice(0, 5);

        document.getElementById('event-start-time').value = startTime;
        document.getElementById('event-end-time').value = endFormatted;

        const dayOfWeek = selectedDate.toLocaleDateString('en-US', { weekday: 'long' });
        document.getElementById('event-day-of-week').value = dayOfWeek;

        document.querySelectorAll('#event-form [id$="-error"]').forEach(el => el.classList.add('hidden'));
    }

    function showEventDetails(event) {
        selectedEvent = event;
        document.getElementById('event-id').value = event.id;
        document.getElementById('event-title').value = event.title;
        document.getElementById('event-teacher').value = event.extendedProps.teacher || '';
        document.getElementById('event-class').value = event.extendedProps.classroom || '';
        document.getElementById('event-room').value = event.extendedProps.room || '';
        document.getElementById('event-day-of-week').value = event.extendedProps.day_of_week || event.start.toLocaleDateString('en-US', { weekday: 'long' });
        document.getElementById('event-start-time').value = event.start.toTimeString().slice(0, 5);
        document.getElementById('event-end-time').value = event.end.toTimeString().slice(0, 5);
        eventDetails.classList.remove('hidden');
    }

    function hideEventDetails() {
        eventDetails.classList.add('hidden');
        selectedEvent = null;
    }

    function showDeleteConfirmation(eventId) {
        document.getElementById('delete-event-id').value = eventId;
        deleteModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function hideDeleteConfirmation() {
        deleteModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    addScheduleBtn.addEventListener('click', () => {
        resetForm();
        eventDetails.classList.remove('hidden');
    });

    closeEventDetails.addEventListener('click', hideEventDetails);
    cancelEventBtn.addEventListener('click', hideEventDetails);

    deleteEventBtn.addEventListener('click', () => {
        const eventId = document.getElementById('event-id').value;
        if (eventId) {
            showDeleteConfirmation(eventId);
        }
    });

    deleteModalCloseButtons.forEach(button => {
        button.addEventListener('click', hideDeleteConfirmation);
    });

    document.getElementById('event-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const eventId = document.getElementById('event-id').value;
        const formData = {
            title: document.getElementById('event-title').value,
            teacher_id: document.getElementById('event-teacher').value,
            classroom_id: document.getElementById('event-class').value,
            room: document.getElementById('event-room').value,
            day_of_week: document.getElementById('event-day-of-week').value,
            start_time: document.getElementById('event-start-time').value,
            end_time: document.getElementById('event-end-time').value,
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        const url = eventId ? `/Admin/planning/${eventId}` : '/Admin/planning';
        const method = eventId ? 'PUT' : 'POST';

        const saveButton = document.getElementById('save-event-btn');
        const originalText = saveButton.textContent;
        saveButton.textContent = 'Saving...';
        saveButton.disabled = true;

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            saveButton.textContent = originalText;
            saveButton.disabled = false;

            if (data.success) {
                calendar.refetchEvents();
                hideEventDetails();
                showToast('success', 'Schedule saved successfully!', 3000);
            } else {
                const errorMessage = data.message || 'An error occurred while saving the schedule.';
                showToast('error', errorMessage, 5000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            saveButton.textContent = originalText;
            saveButton.disabled = false;
            showToast('error', 'An error occurred. Please try again.', 5000);
        });
    });

    deleteForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const eventId = document.getElementById('delete-event-id').value;

        const deleteButton = deleteForm.querySelector('button[type="submit"]');
        const originalText = deleteButton.textContent;
        deleteButton.textContent = 'Deleting...';
        deleteButton.disabled = true;

        fetch(`/Admin/planning/${eventId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            deleteButton.textContent = originalText;
            deleteButton.disabled = false;

            if (data.success) {
                calendar.refetchEvents();
                hideDeleteConfirmation();
                hideEventDetails();
                showToast('success', 'Schedule deleted successfully!', 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            deleteButton.textContent = originalText;
            deleteButton.disabled = false;
            showToast('error', 'An error occurred. Please try again.', 5000);
        });
    });

    // Toast utility function
    function showToast(type, message, duration) {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-4 py-2 rounded-lg shadow-lg z-50 text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, duration);
    }
});
</script>