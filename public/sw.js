self.addEventListener('install', e => {
    e.waitUntil(
      // Après l'installation du service worker,
      // ouvre un nouveau cache
      caches.open('mon-cache-pwa').then(cache => {
        // Ajoute toutes les URLs des éléments à mettre en cache
        return cache.addAll([
          '/',
          '/index.html',
          '/about.html',
          '/images/doggo.jpg',
          '/styles/main.min.css',
          '/scripts/main.min.js',
        ]);
      })
    );
   });

   import gulp from 'gulp';
import path from 'path';
import swPrecache from 'sw-precache';

const rootDir = '/';

gulp.task('generate-service-worker', callback => {
  swPrecache.write(path.join(rootDir, 'sw.js'), {
    staticFileGlobs: [
      // Suit et met en cache tous les fichiers qui correspondent à ce modèle
      rootDir + '/**/*.{js,html,css,png,jpg,gif}',
    ],
    stripPrefix: rootDir
  }, callback);
});