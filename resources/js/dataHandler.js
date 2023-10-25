const appointmentsApi = '/api/appointments';
const businessHoursApi = '/api/business-hours';


export let dataHandler = {
    getAppointments: async function () {
        return await apiGet(appointmentsApi);
    },
    getBusinessHours: async function () {
        return await apiGet(businessHoursApi);
    },
    createNewAppointment: async function (payload) {
        return await apiPost(appointmentsApi, payload);
    },
};

async function apiGet(url) {
    let response = await fetch(url, {
        method: "GET",
    });
    if (response.ok) {
        return response.json();
    }
}

async function apiPost(url, payload) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)
    });
    return response;
}

