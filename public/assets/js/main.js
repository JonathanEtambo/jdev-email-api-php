(function () {
  const root = document.documentElement;
  const KEY = 'jdev_theme';

  const setTheme = (theme) => {
    root.setAttribute('data-theme', theme);
    const iconClass = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
    document.querySelectorAll('[data-theme-toggle] i').forEach((i) => {
      i.className = iconClass;
    });
  };

  const stored = localStorage.getItem(KEY);
  if (stored === 'dark' || stored === 'light') {
    setTheme(stored);
  } else {
    setTheme('light');
  }

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-theme-toggle]');
    if (!btn) return;
    const current = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem(KEY, next);
    setTheme(next);
  });
})();
