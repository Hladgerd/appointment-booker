const appointmentsApi = '/api/appointments';
const businessHoursApi = '/api/business-hours';


export let dataHandler = {
    getAppointments: async function () {
        return await apiGet(appointmentsApi);
    },
    getBusinessHours: async function () {
        return await apiGet(businessHoursApi);
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
    if (response.ok) {
        return response.json();
    }
}

async function apiDelete(url) {
    const response = await fetch(url, {
        method: 'DELETE',
        headers: {'Content-Type': 'application/json'},
    });
    if (response.ok) {
        return response.json();
    }
}

async function apiPut(url, data) {
    const response = await fetch(url, {
        method: 'PUT',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data),
    });
    if (response.ok) {
        return response.json();
    }
}
