import { addEvent, getEvents, clearEvents, removeEvent } from './localstorage';

document.addEventListener('DOMContentLoaded', () => {
    // Example: Add event
    document.getElementById('addEventButton').addEventListener('click', () => {
        const event = {
            id: Date.now(),
            title: 'New Event',
            start_date: '2024-07-01',
            start_time: '10:00',
            end_date: '2024-07-01',
            end_time: '12:00',
            notes: 'Event notes',
            is_completed: false,
            external_recipients: 'example@example.com'
        };
        addEvent(event);
        console.log('Event added to local storage');
    });

    // Example: Get events
    document.getElementById('getEventsButton').addEventListener('click', () => {
        const events = getEvents();
        console.log('Events from local storage:', events);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    if ('serviceWorker' in navigator && 'SyncManager' in window) {
        navigator.serviceWorker.ready.then(registration => {
            document.getElementById('syncEventsButton').addEventListener('click', async () => {
                try {
                    await registration.sync.register('sync-events');
                    console.log('Sync registered');
                } catch (error) {
                    console.error('Sync registration failed:', error);
                }
            });
        });
    }

    // Sync immediately when online
    window.addEventListener('online', async () => {
        const registration = await navigator.serviceWorker.ready;
        await registration.sync.register('sync-events');
    });
});
