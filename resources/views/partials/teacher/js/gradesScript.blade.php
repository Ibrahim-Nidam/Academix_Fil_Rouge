<script>
document.addEventListener('DOMContentLoaded', function() {
    const flashEl = document.getElementById('flashMessage');
    const flashContent = flashEl.querySelector('.flash-content');
    const flashClose = document.getElementById('closeFlash');
    let flashTimeout;

    function showFlashMessage(message, type = 'success') {
        clearTimeout(flashTimeout);
        flashContent.textContent = message;
        flashEl.classList.remove('hidden', 'bg-green-500', 'bg-red-500');
        flashEl.classList.add(type === 'error' ? 'bg-red-500' : 'bg-green-500');
        flashEl.classList.remove('opacity-0');
        flashEl.classList.add('opacity-100');
        flashTimeout = setTimeout(() => {
            flashEl.classList.add('opacity-0');
            setTimeout(() => flashEl.classList.add('hidden'), 300);
        }, 5000);
    }

    flashClose.addEventListener('click', () => {
        clearTimeout(flashTimeout);
        flashEl.classList.add('opacity-0');
        setTimeout(() => flashEl.classList.add('hidden'), 300);
    });

    let currentClassroomId = null;
    let currentExamId = null;

    const classCards = document.querySelectorAll('.class-card');
    const examSelector = document.getElementById('examSelector');
    const addExamBtn = document.getElementById('addExamBtn');
    const addExamModal = document.getElementById('addExamModal');
    const closeExamModalBtn = document.getElementById('closeExamModal');
    const cancelExamBtn = document.getElementById('cancelExamBtn');
    const modalOverlay = document.getElementById('modalOverlay');
    const addExamForm = document.getElementById('addExamForm');
    const gradesTableBody = document.getElementById('gradesTableBody');
    const submitGradesBtn = document.getElementById('submitGradesBtn');
    const examClassroomId = document.getElementById('examClassroomId');
    const modalClassInfo = document.getElementById('modalClassInfo');

    // Select first classroom by default
    if (classCards.length) {
        currentClassroomId = classCards[0].dataset.classId;
        loadExamsForClassroom(currentClassroomId);
    }

    // Classroom selection
    classCards.forEach(card => {
        card.addEventListener('click', () => {
            classCards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            const className   = card.querySelector('h3').textContent;
            const subjectName = card.querySelector('p').textContent;
            document.querySelector('#gradingSection h2').textContent = className;
            document.querySelector('#gradingSection p').textContent  = subjectName;
            currentClassroomId = card.dataset.classId;
            loadExamsForClassroom(currentClassroomId);
            examSelector.value = '';
            currentExamId     = null;
            resetGradesTable();
        });
    });

    // Load exams
    function loadExamsForClassroom(classroomId) {
        fetch(`/Teacher/grades/classroom/${classroomId}/exams`)
            .then(res => {
                if (!res.ok) throw new Error();
                return res.json();
            })
            .then(exams => {
                examSelector.innerHTML = '<option value="">Select an exam/assignment...</option>';
                exams.forEach(exam => {
                    const opt = document.createElement('option');
                    opt.value = exam.id;
                    opt.textContent = `${exam.title} (${exam.type.charAt(0).toUpperCase()+exam.type.slice(1)}, ${formatDate(exam.date)})`;
                    examSelector.appendChild(opt);
                });
            })
            .catch(() => {
                console.error("Error loading exams");
                showFlashMessage("Error loading exams. Please try again.", 'error');
        });
    }

    // Exam change
    examSelector.addEventListener('change', function() {
        currentExamId = this.value;
        if (currentExamId) {
            loadGradesForExam(currentExamId);
            submitGradesBtn.disabled = false;
        } else {
            resetGradesTable();
            submitGradesBtn.disabled = true;
        }
    });

    // Load grades
    function loadGradesForExam(examId) {
        fetch(`/Teacher/grades/exams/${examId}`)
            .then(res => {
                if (!res.ok) throw new Error();
                return res.json();
            })
            .then(data => {
                gradesTableBody.innerHTML = '';
                data.students.forEach(student => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center mr-3">
                            <span class="font-medium">${student.name.charAt(0)}</span>
                        </div>
                        <div>
                            <div class="font-medium">${student.name}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ID: ${student.id}</div>
                        </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" min="0" max="20" step="0.01" value="${student.grade ?? ''}" class="grade-input form-input" data-student-id="${student.id}">
                    </td>
                    <td class="px-6 py-4">
                        <textarea class="form-textarea w-full" rows="2" data-student-id="${student.id}">${student.comment || ''}</textarea>
                    </td>
                    `;
                    gradesTableBody.appendChild(tr);
                });
                if (!data.students.length) {
                    gradesTableBody.innerHTML = `
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No students found in this class
                        </td>
                    </tr>`;
                }
            })
            .catch(() => {
                console.error("Error loading grades");
                showFlashMessage("Error loading grades. Please try again.", 'error');
        });
    }

    function resetGradesTable() {
        gradesTableBody.innerHTML = `
            <tr>
            <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                Select an exam/assignment to view and enter grades
            </td>
            </tr>`;
        submitGradesBtn.disabled = true;
    }

    function openExamModal() {
    addExamModal.classList.remove('hidden');
    }
    
    function closeExamModal() {
    addExamModal.classList.add('hidden');
    }
    
    addExamBtn.addEventListener('click', openExamModal);
    closeExamModalBtn.addEventListener('click', closeExamModal);
    cancelExamBtn.addEventListener('click', closeExamModal);
    modalOverlay.addEventListener('click', closeExamModal);
    
    </script>