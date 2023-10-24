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
        hour12: false,
        firstDay: 1,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: "dayGridMonth",
        selectable: true,
        events: appointment,
        timeFormat: 'H:mm',
    });

    calendar.render();
});
