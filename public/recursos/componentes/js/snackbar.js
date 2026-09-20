(function(){
  const SNACKBAR_CLASS = 'rdm-snackbar--container';
  const VISIBLE_CLASS = 'is-visible';
  const DEFAULT_TIMEOUT = 2600;
  const VARIANT_CLASS_MAP = {
    default: 'rdm-snackbar--info',
    info: 'rdm-snackbar--info',
    informacion: 'rdm-snackbar--info',
    success: 'rdm-snackbar--success',
    exito: 'rdm-snackbar--success',
    ok: 'rdm-snackbar--success',
    warning: 'rdm-snackbar--warning',
    advertencia: 'rdm-snackbar--warning',
    warn: 'rdm-snackbar--warning',
    error: 'rdm-snackbar--error',
    danger: 'rdm-snackbar--error'
  };
  const VARIANT_STYLE_MAP = {
    default: 'default',
    info: 'info',
    informacion: 'info',
    success: 'success',
    exito: 'success',
    ok: 'success',
    warning: 'warning',
    advertencia: 'warning',
    warn: 'warning',
    error: 'error',
    danger: 'error'
  };
  const VARIANT_STYLES = {
    default: {
      contentBg: '',
      contentColor: '',
      actionColor: ''
    },
    info: {
      contentBg: 'var(--md-sys-color-inverse-surface)',
      contentColor: 'var(--md-sys-color-inverse-on-surface)',
      actionColor: 'var(--md-sys-color-primary)'
    },
    success: {
      contentBg: '#e8f5e9',
      contentColor: '#1b5e20',
      actionColor: '#2e7d32'
    },
    warning: {
      contentBg: '#fef3c7',
      contentColor: '#1f2937',
      actionColor: '#92400e'
    },
    error: {
      contentBg: 'var(--md-sys-color-error-container)',
      contentColor: 'var(--md-sys-color-on-error-container)',
      actionColor: 'var(--md-sys-color-error)'
    }
  };

  function normalizeVariant(variant) {
    if (typeof variant !== 'string') {
      return 'default';
    }

    const value = variant.toLowerCase().trim();
    return Object.prototype.hasOwnProperty.call(VARIANT_CLASS_MAP, value) ? value : 'default';
  }

  function createSnackbar(message, actionLabel, actionHandler, timeout = DEFAULT_TIMEOUT, variant = 'default') {
    const existing = document.querySelector(`.${SNACKBAR_CLASS}`);
    if (existing) {
      existing.remove();
    }

    const normalizedVariant = normalizeVariant(variant);
    const wrapper = document.createElement('div');
    wrapper.className = SNACKBAR_CLASS;
    wrapper.classList.add(VARIANT_CLASS_MAP[normalizedVariant]);

    const content = document.createElement('div');
    content.className = 'rdm-snackbar--content';
    const variantKey = VARIANT_STYLE_MAP[normalizedVariant] || 'default';
    const variantStyles = VARIANT_STYLES[variantKey] || VARIANT_STYLES.default;
    if (variantStyles.contentBg) {
      content.style.backgroundColor = variantStyles.contentBg;
    }
    if (variantStyles.contentColor) {
      content.style.color = variantStyles.contentColor;
    }

    const text = document.createElement('div');
    text.className = 'rdm-snackbar--message';
    text.textContent = message;

    content.appendChild(text);

    if (actionLabel) {
      const actionBtn = document.createElement('button');
      actionBtn.type = 'button';
      actionBtn.className = 'rdm-snackbar--action';
      actionBtn.textContent = actionLabel;
      if (variantStyles.actionColor) {
        actionBtn.style.color = variantStyles.actionColor;
      }
      actionBtn.addEventListener('click', function () {
        if (typeof actionHandler === 'function') {
          actionHandler();
        }
        hideSnackbar(wrapper);
      });
      content.appendChild(actionBtn);
    }

    wrapper.appendChild(content);
    document.body.appendChild(wrapper);

    requestAnimationFrame(function () {
      wrapper.classList.add(VISIBLE_CLASS);
    });

    window.clearTimeout(wrapper._hideTimer);
    wrapper._hideTimer = window.setTimeout(function () {
      hideSnackbar(wrapper);
    }, timeout);

    return wrapper;
  }

  function hideSnackbar(wrapper) {
    if (!wrapper || !wrapper.parentNode) return;
    wrapper.classList.remove(VISIBLE_CLASS);
    window.setTimeout(function () {
      if (wrapper.parentNode) {
        wrapper.parentNode.removeChild(wrapper);
      }
    }, 220);
  }

  window.rdmShowSnackbar = function (message, actionLabel, actionHandler, timeout, variant) {
    return createSnackbar(message, actionLabel, actionHandler, timeout, variant);
  };
})();