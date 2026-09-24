/*
  Toggle de tema claro/oscuro directo:
  - Alterna entre 'light' y 'dark' al hacer clic.
  - Inyecta un stylesheet override con las variables :root del tema elegido.
  - Persiste en localStorage bajo la clave 'rdm-theme'.
  - Expone el tema actual en `document.documentElement.dataset.theme`.
*/
(function(){
  const STORAGE_KEY = 'rdm-theme';
  let toggleEl = null;
  let iconEl = null;

  // Lista base de variables de color a reasignar
  const VAR_KEYS = [
    'primary','on-primary','primary-container','on-primary-container',
    'secondary','on-secondary','secondary-container','on-secondary-container',
    'tertiary','on-tertiary','tertiary-container','on-tertiary-container',
    'error','error-container','on-error','on-error-container',
    'background','on-background','surface','on-surface',
    'surface-variant','on-surface-variant','outline',
    'inverse-on-surface','inverse-surface','inverse-primary',
    'shadow','surface-tint','outline-variant','scrim'
  ];

  function getSystemTheme(){
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function readToken(name){
    return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
  }

  function setRootVar(name, value){
    document.documentElement.style.setProperty(name, value);
  }

  function applyTheme(theme){
    const t = theme === 'dark' ? 'dark' : 'light';
    // Asignar cada variable principal a su token light/dark
    VAR_KEYS.forEach(key => {
      const tokenName = `--md-sys-color-${key}-${t}`;
      const mainName = `--md-sys-color-${key}`;
      const tokenValue = readToken(tokenName);
      if (tokenValue) setRootVar(mainName, tokenValue);
    });
    document.documentElement.dataset.theme = t;
    updateIcon(t);
  }

  function updateIcon(theme){
    if (iconEl){
      iconEl.textContent = theme === 'dark' ? 'dark_mode' : 'light_mode';
    }
    if (toggleEl){
      toggleEl.setAttribute('aria-label', theme === 'dark' ? 'Tema oscuro' : 'Tema claro');
      toggleEl.title = theme === 'dark' ? 'Cambiar a claro' : 'Cambiar a oscuro';
    }
  }

  function setCookieTheme(theme){
    try {
      var maxAge = 60 * 60 * 24 * 365; // ~1 año
      document.cookie = `rdm-theme=${theme};path=/;max-age=${maxAge}`;
    } catch(e) {}
  }

  function withTransition(run, duration = 500){
    const root = document.documentElement;
    root.classList.add('theme-transition');
    if (window.__rdmThemeTransTimer) clearTimeout(window.__rdmThemeTransTimer);
    try {
      run();
    } finally {
      window.__rdmThemeTransTimer = setTimeout(() => {
        root.classList.remove('theme-transition');
      }, duration);
    }
  }

  function toggleTheme(){
    const saved = localStorage.getItem(STORAGE_KEY);
    const current = (saved === 'dark' || saved === 'light') ? saved : getSystemTheme();
    const next = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem(STORAGE_KEY, next);
    setCookieTheme(next);
    withTransition(() => applyTheme(next));
  }

  function init(){
    if (window.__rdmThemeToggleInit) return; // guard contra doble inclusión
    window.__rdmThemeToggleInit = true;
    toggleEl = document.getElementById('themeToggle');
    iconEl = document.getElementById('themeToggleIcon');
    const saved = localStorage.getItem(STORAGE_KEY);
    const initial = (saved === 'dark' || saved === 'light') ? saved : getSystemTheme();
    setCookieTheme(initial);
    // En carga inicial NO activamos transiciones para evitar destello
    applyTheme(initial);
    if (toggleEl) toggleEl.addEventListener('click', toggleTheme);
    else {
      // Fallback: delegación por si el elemento aparece dinámicamente
      document.addEventListener('click', function(e){
        const t = e.target.closest('#themeToggle');
        if (t) toggleTheme();
      });
    }
  }

  document.addEventListener('DOMContentLoaded', init);
})();

/* Ripple ligero para botones y listas */
(function(){
  const SELECTOR = 'button, .rdm-list--container';

  function prefersReducedMotion(){
    return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }

  function createRipple(target, x, y){
    const rect = target.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height) * 1.2;
    const ripple = document.createElement('span');
    ripple.className = 'rdm-ripple-circle';
    ripple.style.width = ripple.style.height = `${size}px`;
    ripple.style.left = `${x - rect.left - size / 2}px`;
    ripple.style.top = `${y - rect.top - size / 2}px`;
    target.appendChild(ripple);
    ripple.addEventListener('animationend', () => ripple.remove(), { once: true });
  }

  function onPointerDown(e){
    const target = e.target.closest(SELECTOR);
    if (!target) return;
    if (target.hasAttribute('disabled')) return;
    if (prefersReducedMotion()) return;
    createRipple(target, e.clientX, e.clientY);
  }

  document.addEventListener('pointerdown', onPointerDown);
})();
