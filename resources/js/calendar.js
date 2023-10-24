import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import rrulePlugin from '@fullcalendar/rrule';
import huLocale from "@fullcalendar/core/locales/hu";

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    let calendar = new Calendar(calendarEl, {
        plugins: [ interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin, rrulePlugin ],
        timeZone: "Europe/Budapest",
        locale: huLocale,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: "dayGridMonth",
        views: {
            dayGridMonth: {
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false}
            }
        },
        selectable: true,
        events: appointment,
    });

    calendar.render();
});
