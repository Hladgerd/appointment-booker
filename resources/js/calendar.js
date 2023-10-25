import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import rrulePlugin from '@fullcalendar/rrule';
import huLocale from "@fullcalendar/core/locales/hu";

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    // FullCalendar Options
    let calendar = new Calendar(calendarEl, {
        plugins: [
            interactionPlugin,
            dayGridPlugin,
            timeGridPlugin,
            listPlugin,
            rrulePlugin
        ],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        views: {
            dayGridMonth: {
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false}
            }
        },
        timeZone: "Europe/Budapest",
        locale: huLocale,
        initialView: "dayGridMonth",
        selectable: true,
        navLinks: true,
        events: appointment,
    });

    calendar.render();
});
