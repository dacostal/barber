window.onload = () => {
    let availabilities = document.querySelector("#availabilities");

    let calendar = new FullCalendar.Calendar(availabilities, {
        initialView: 'dayGridWeek',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        firstDay: (new Date().getDay()),
        themeSystem: 'bootstrap',
        events : {{data | raw}}
        headerToolbar: {
            start: 'prev,next',
            center: 'title',
            end: 'today'
        },
        buttonText: {
            today: 'Aujourd\'hui'
        }
    });

    calendar.render();
}
