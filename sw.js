const CACHE_NAME = 'sabores-offline-v3'; // Version 3 evalúa invalidar vieja caché por completo
const OFFLINE_URL = './offline.html';

const urlsToCache = [
  OFFLINE_URL,
  './assets/images/brand/logo.png',
  './assets/images/brand/logo-solid.png'
];

// Instalar Service Worker y cachear solo página de "Sin Conexión"
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
      .then(() => self.skipWaiting())
  );
});

// Activar y borrar todas las cachés persistentes anteriores permanentemente
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== CACHE_NAME) {
            console.log('Borrando caché antigua de PWA:', cache);
            return caches.delete(cache);
          }
        })
      );
    }).then(() => self.clients.claim()) // Fuerza a los clientes a actualizarse rápido
  );
});

// Interceptar peticiones (Red Obligatoria con Fallback Visual para Offline)
self.addEventListener('fetch', event => {
  // Las navegaciones a pantallas / páginas enteras usan fallback a la vista offline
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request).catch(error => {
        console.log('Fallo de Red en navegación. Retornando página offline.', error);
        return caches.match(OFFLINE_URL);
      })
    );
  } else {
    // Para cualquier otro recurso (css, img, js), siempre ir a la red (nada de caché)
    // Con excepción del logo necesario para la página offline
    event.respondWith(
      fetch(event.request).catch(error => {
        return caches.match(event.request).then(response => {
           return response || new Response('', { status: 404 });
        });
      })
    );
  }
});
