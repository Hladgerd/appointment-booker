import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import rrulePlugin from '@fullcalendar/rrule';
import huLocale from "@fullcalendar/core/locales/hu";
import {dataHandler} from "./dataHandler.js";


document.addEventListener('DOMContentLoaded', async function () {
    const calendarEl = document.getElementById('calendar');
    const appointments = await dataHandler.getAppointments();
    const businessHours = await dataHandler.getBusinessHours();
    const events = appointments.concat(businessHours);

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
                eventTimeFormat: {hour: '2-digit', minute: '2-digit', hour12: false}
            }
        },
        timeZone: "Europe/Budapest",
        locale: huLocale,
        initialView: "dayGridMonth",
        weekNumbers: true,
        slotMinTime: '06:00:00',
        selectable: true,
        navLinks: true,
        events: events,
    });

    calendar.render();
});
