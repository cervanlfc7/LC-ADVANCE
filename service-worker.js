const CACHE_NAME = "lc-advance-v5";
const SW_PATH = self.location.pathname;
const BASE = SW_PATH.substring(0, SW_PATH.lastIndexOf("/") + 1);

const URLS = [
  BASE + "index.php",
  BASE + "public/dashboard.php",
  BASE + "public/assets/css/dashboard.css",
  BASE + "public/assets/js/app.min.js",
  BASE + "public/assets/js/loader.min.js",
  BASE + "public/assets/js/volume_control.min.js",
];

function isSameOrigin(url) {
  try {
    return new URL(url).origin === self.location.origin;
  } catch (e) {
    return false;
  }
}

function isCacheableResponse(response) {
  if (!response || !response.ok) return false;
  const status = response.status;
  if (status === 206) return false;
  return status < 300 || status === 304;
}

self.addEventListener("install", (event) => {
  self.skipWaiting();
  event.waitUntil(
    caches
      .open(CACHE_NAME)
      .then((cache) => cache.addAll(URLS))
      .catch(() => Promise.resolve()),
  );
});

self.addEventListener("activate", (event) => {
  event.waitUntil(
    caches
      .keys()
      .then((keys) =>
        Promise.all(
          keys.map((key) =>
            key !== CACHE_NAME ? caches.delete(key) : Promise.resolve(),
          ),
        ),
      )
      .then(() => self.clients.claim()),
  );
});

self.addEventListener("fetch", (event) => {
  if (event.request.method !== "GET") return;

  const requestUrl = new URL(event.request.url);
  if (!isSameOrigin(event.request.url)) return;

  const acceptHeader = event.request.headers.get("Accept") || "";
  const isHtmlRequest =
    event.request.mode === "navigate" || acceptHeader.includes("text/html");
  const isAuthPage = /login\.php$|logout\.php$/.test(requestUrl.pathname);

  if (isHtmlRequest) {
    event.respondWith(
      fetch(event.request.clone(), { cache: "no-store" })
        .then((response) => {
          if (!isAuthPage && response.ok) {
            const copy = response.clone();
            caches
              .open(CACHE_NAME)
              .then((cache) => cache.put(event.request, copy));
          }
          return response;
        })
        .catch(() => caches.match(event.request)),
    );
    return;
  }

  event.respondWith(
    caches.match(event.request).then((cached) => {
      if (cached) return cached;
      return fetch(event.request)
        .then((response) => {
          if (isCacheableResponse(response)) {
            const copy = response.clone();
            caches
              .open(CACHE_NAME)
              .then((cache) => cache.put(event.request, copy));
          }
          return response;
        })
        .catch(() => cached);
    }),
  );
});
