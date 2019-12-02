const filesToCache = [
    '/',
    '/css/app.css',
    '/assets/css/bootstrap.min.css',
    '/assets/css/bootstrap_water.min.css',
    '/assets/css/layout.min.css',
    '/assets/css/components.min.css',
    '/assets/css/colors.min.css',
    '/global_assets/js/main/jquery.min.js',
    '/global_assets/js/main/bootstrap.bundle.min.js',
    '/global_assets/js/plugins/loaders/blockui.min.js',
    '/assets/js/app.js',
    '/global_assets/js/demo_pages/navbar_multiple_sticky.js',
    '/global_assets/js/plugins/notifications/pnotify.min.js',
];

const dataCacheName = 'v1';

// on install state
self.addEventListener('install', function(e){
    e.waitUntil(
        caches.open(dataCacheName).then(function(cache) {
            return cache.addAll(filesToCache);
        }, (err) => {
            return cache.addAll(filesToCache);
        })
    );
});
self.addEventListener('activate', function(event) {
    console.log('Finally active. Ready to start serving content!');
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                    // Cache hit - return response
                    if (response) {
                        return response;
                    }
                    return fetch(event.request);
                }
            )
    );
});