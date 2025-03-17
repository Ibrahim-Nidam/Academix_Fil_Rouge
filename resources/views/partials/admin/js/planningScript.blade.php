<script>
    const eventDetails = document.getElementById('event-details');
    const mobileEventModal = document.getElementById('mobile-event-modal');
    const deleteModal = document.getElementById('delete-modal');
    const successToast = document.getElementById('success-toast');
    
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
    

</script>