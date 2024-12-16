document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar-container');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            { title: 'Consultation', start: '2024-11-22' },
            { title: 'Follow-up', start: '2024-11-24' },
        ]
    });
    calendar.render();
});
