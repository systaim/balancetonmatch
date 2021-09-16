const staticCacheName = "cache-v1"
const assets = [
    "/",
]

// ajout fichiers en cache
self.addEventListener('install', (e) => {
    e.waitUntil(
        caches.open(staticCacheName).then((cache) => {
            cache.addAll(assets)
        })
    )
})