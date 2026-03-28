const CACHE_NAME = 'sabores-yb-v1';
const urlsToCache = [
  './',
  './index.html',
  './about.html',
  './assets/images/logo.png'
];

// Instalar Service Worker y cachear recursos iniciales
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        cache.addAll(urlsToCache);
        self.skipWaiting();
      })
  );
});

// Activar el Service Worker y eliminar cachés antiguos
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== CACHE_NAME) {
            return caches.delete(cache);
          }
        })
      );
    })
  );
});

// Interceptar peticiones para que funcione offline
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        // Usa la caché si la encuentra, de lo contrario hace la petición a la red
        return response || fetch(event.request).then(fetchRes => {
          // Opcional: Caché dinámica para guardar los elementos que no estaban
          return caches.open(CACHE_NAME).then(cache => {
            // Solo cachar peticiones HTTP válidas y excluyendo extensiones si es necesario
            if (event.request.url.startsWith('http')) {
              cache.put(event.request, fetchRes.clone());
            }
            return fetchRes;
          });
        });
      }).catch(() => {
        // En caso de que falle la red y no haya caché (ej offline completo para algo nuevo)
        // se podría devolver un fallback aquí
      })
  );
});
