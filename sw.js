importScripts('js/idb.js');
importScripts('js/utility.js');

var CACHE_STATIC_NAME = 'static-v2';
var CACHE_DYNAMIC_NAME = 'dynamic-v2';
var STATIC_FILES = [];

var STATIC_FILES = [
    'index.php',
    'js/app.js',
    'js/feed.js',
    'js/idb.js',
    'js/promise.js',
    'js/fetch.js',
    'css/bootstrap.min.css',
    'js/jquery-3.3.1.min.js',
    'js/material.min.js',
    'js/bootstrap.js',
    'images/icons/icon-72x72.png',
    'images/icons/icon-96x96.png',
    'images/icons/icon-128x128.png',
    'images/icons/icon-144x144.png',
    'images/icons/icon-152x152.png',
    'images/icons/icon-192x192.png',
    'images/icons/icon-384x384.png',
    'images/icons/icon-512x512.png'

];


this.addEventListener('fetch', function (event) {
    // it can be empty if you just want to get rid of that error
});






self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installing Service Worker ...', event);
    event.waitUntil(
        caches.open(CACHE_STATIC_NAME)
            .then(function (cache) {
                console.log('[Service Worker] Precaching App Shell');
                cache.addAll(STATIC_FILES);
            })
    )
});

self.addEventListener('activate', function (event) {
    console.log('[Service Worker] Activating Service Worker ....', event);
    event.waitUntil(
        caches.keys()
            .then(function (keyList) {
                return Promise.all(keyList.map(function (key) {
                    if (key !== CACHE_STATIC_NAME && key !== CACHE_DYNAMIC_NAME) {
                        console.log('[Service Worker] Removing old cache.', key);
                        return caches.delete(key);
                    }
                }));
            })
    );
    return self.clients.claim();
});



function isInArray(string, array) {
    var cachePath;
    if (string.indexOf(self.origin) === 0) { // request targets domain where we serve the page from (i.e. NOT a CDN)
        console.log('matched ', string);
        cachePath = string.substring(self.origin.length); // take the part of the URL AFTER the domain (e.g. after localhost:8080)
    } else {
        cachePath = string; // store the full request (for CDNs)
    }
    return array.indexOf(cachePath) > -1;
}



// self.addEventListener('fetch', function (event) {

//     var url = 'http://localhost:8881/ocim/get_courses.php';

//     if (event.request.url.indexOf(url) > -1) {
//         event.respondWith(
//             fetch(event.request)
//                 .then(function (res) {

//                     var cloneRes = res.clone();

//                     clearAllData('courses')
//                         .then(function () {
//                             return cloneRes.json();
//                         })
//                         .then(function (data) {
//                             for (var key in data) {
//                                 writeData('courses', data[key]);

//                             }
//                         })

//                     return res;
//                 })
//         );
//     } else if (isInArray(event.request.url, STATIC_FILES)) {
//         event.respondWith(
//             caches.match(event.request)
//                 .then(function (res) {
//                     return res;
//                 })
//         )
//     }
//     else {
//         event.respondWith(
//             caches.match(event.request)
//                 .then(function (response) {
//                     if (response) {
//                         return response;
//                     } else {
//                         return fetch(event.request)
//                             .then(function (res) {
//                                 return caches.open(CACHE_DYNAMIC_NAME)
//                                     .then(function (cache) {
//                                         trimCache(CACHE_DYNAMIC_NAME, 3);
//                                         cache.put(event.request.url, res.clone());
//                                         return res
//                                     });
//                             })
//                             .catch(function (err) {
//                                 return caches.open(CACHE_STATIC_NAME)
//                                     .then(function (cache) {
//                                         if (event.request.headers.get('accept').includes('text/html')) {
//                                             return cache.match('http://localhost:8881/ocim/offline.php');
//                                         }
//                                     });
//                             });
//                     }
//                 })
//         );
//     }
// });
