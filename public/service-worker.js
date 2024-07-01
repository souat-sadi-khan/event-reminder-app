const CACHE_NAME = 'event-reminder-cache-v1';
const urlsToCache = [
    '/',
    '/css/app.css',
    '/js/app.js',
    // Add more URLs to cache
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    return response;
                }
                return fetch(event.request);
            })
    );
});

self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

self.addEventListener('sync', event => {
    if (event.tag === 'sync-events') {
        event.waitUntil(syncEvents());
    }
});

async function syncEvents() {
    const events = JSON.parse(localStorage.getItem('events')) || [];
    for (const event of events) {
        try {
            const response = await fetch('/api/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(event),
            });
            if (response.ok) {
                removeEvent(event.id); // Remove event from local storage if successfully synced
            }
        } catch (error) {
            console.error('Sync failed:', error);
        }
    }
}
