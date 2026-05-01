const CACHE_NAME = "lc-advance-v2";
const URLS = [
  "/LC-ADVANCE/index.php",
  "/LC-ADVANCE/dashboard.php",
  "/LC-ADVANCE/assets/css/dashboard.css",
];

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

  const acceptHeader = event.request.headers.get("Accept") || "";
  const isHtmlRequest =
    event.request.mode === "navigate" || acceptHeader.includes("text/html");
  const requestUrl = new URL(event.request.url);
  const isAuthPage = /\/login\.php$|\/logout\.php$/.test(requestUrl.pathname);

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
          const copy = response.clone();
          caches
            .open(CACHE_NAME)
            .then((cache) => cache.put(event.request, copy));
          return response;
        })
        .catch(() => cached);
    }),
  );
});
