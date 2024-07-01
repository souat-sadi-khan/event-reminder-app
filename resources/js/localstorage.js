const LOCAL_STORAGE_KEY = 'events';

export function addEvent(event) {
    let events = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY)) || [];
    events.push(event);
    localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(events));
}

export function getEvents() {
    return JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY)) || [];
}

export function clearEvents() {
    localStorage.removeItem(LOCAL_STORAGE_KEY);
}

export function removeEvent(eventId) {
    let events = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY)) || [];
    events = events.filter(event => event.id !== eventId);
    localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(events));
}

// Expose the functions globally
window.localStorageUtil = {
    addEvent: addEvent,
    getEvents: getEvents,
    clearEvents: clearEvents,
    removeEvent: removeEvent
};