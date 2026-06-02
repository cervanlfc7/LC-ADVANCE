// Volume Manager — centraliza el control de volumen y manejo de autoplay
(function () {
  const STORAGE_KEY = "lc_volume_settings";

  function getStoredVolumes() {
    try {
      const s = localStorage.getItem(STORAGE_KEY);
      if (s) return JSON.parse(s);
    } catch (e) {
      /* ignore */
    }
    return { principal: 1.0, ambiental: 0.8, examenes: 0.8 };
  }

  function saveVolumes(v) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(v));
    } catch (e) {}
  }

  function injectStyles() {
    if (document.getElementById("lc-volume-styles")) return;
    const css = `
    #lc-play-btn{position:fixed;right:18px;bottom:18px;z-index:10000;background:#00e5ff;color:#002; border:none;padding:10px 14px;border-radius:8px;cursor:pointer;box-shadow:0 6px 18px rgba(0,0,0,0.35);font-size:16px}
    #lc-volume-control{position:fixed;right:18px;bottom:72px;z-index:10000;background:rgba(0,0,0,0.65);padding:8px;border-radius:10px;border:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;gap:8px}
    #lc-volume-control input[type=range]{width:120px}
    `;
    const s = document.createElement("style");
    s.id = "lc-volume-styles";
    s.innerHTML = css;
    document.head.appendChild(s);
  }

  function showPlayButton(audio, volume) {
    injectStyles();
    let btn = document.getElementById("lc-play-btn");
    if (!btn) {
      btn = document.createElement("button");
      btn.id = "lc-play-btn";
      btn.textContent = "▶ Play music";
      btn.addEventListener("click", () => {
        audio.volume = Math.min(1, volume || 1);
        audio
          .play()
          .then(() => {
            btn.remove();
            const vc = document.getElementById("lc-volume-control");
            if (vc) vc.style.display = "flex";
          })
          .catch((e) => console.log("Play still blocked", e));
      });
      document.body.appendChild(btn);
    }
  }

  function addVolumeUI(audio, initialVolume) {
    injectStyles();
    if (document.getElementById("lc-volume-control")) return;
    const v = getStoredVolumes();
    const container = document.createElement("div");
    container.id = "lc-volume-control";
    container.innerHTML = `<label style="color:#dff; font-size:13px">Vol</label><input id="lc-vol-range" type="range" min="0" max="1" step="0.01" value="${(v.principal || initialVolume || 1).toFixed(2)}">`;
    const range = container.querySelector("#lc-vol-range");
    range.addEventListener("input", function () {
      const val = parseFloat(this.value);
      audio.volume = val;
      v.principal = val;
      saveVolumes(v);
    });
    document.body.appendChild(container);
  }

  window.initPageAudio = function (audioId, overrideVolume) {
    try {
      const audio = document.getElementById(audioId);
      if (!audio) return;
      const volumes = getStoredVolumes();
      const vol =
        typeof overrideVolume === "number"
          ? Math.max(0, Math.min(1, overrideVolume))
          : Math.max(0, Math.min(1, parseFloat(volumes.principal) || 1));
      audio.volume = vol;
      audio.muted = false;
      // try to play; if blocked, show play button
      audio
        .play()
        .then(() => {
          // success
          addVolumeUI(audio, vol);
          const btn = document.getElementById("lc-play-btn");
          if (btn) btn.remove();
        })
        .catch((e) => {
          console.log("Audio play blocked or failed:", e);
          showPlayButton(audio, vol);
          addVolumeUI(audio, vol);
        });
    } catch (e) {
      console.error("initPageAudio error", e);
    }
  };
})();
