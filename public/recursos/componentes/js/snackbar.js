/**
 * JavaScript para ManGoApp
 * SNACKBAR COMPONENT (MD3)
 * Autor: Danny Estrada
 */

(function () {
  'use strict';

  window.RDM = window.RDM || {};

  let wrapper = null;

  function getOrCreateWrapper() {
    if (!wrapper || !document.body.contains(wrapper)) {
      wrapper = document.querySelector('.rdm-snackbar--wrapper');
      if (!wrapper) {
        wrapper = document.createElement('div');
        wrapper.className = 'rdm-snackbar--wrapper';
        document.body.appendChild(wrapper);
      }
    }
    return wrapper;
  }

  const defaultIcons = {
    neutral: 'info',
    success: 'check_circle',
    error: 'error',
    warning: 'warning',
    info: 'info'
  };

  /**
   * Muestra un snackbar programáticamente
   * @param {Object|string} options Opciones o texto del mensaje
   */
  function show(options) {
    if (typeof options === 'string') {
      options = { message: options };
    }

    const config = Object.assign({
      message: '',
      type: 'neutral', // neutral, success, error, warning, info
      duration: 4000,
      actionText: null,
      onAction: null,
      dismissible: true,
      icon: null
    }, options);

    const container = getOrCreateWrapper();

    // Crear elemento snackbar
    const snackbar = document.createElement('div');
    snackbar.className = `rdm-snackbar rdm-snackbar--${config.type}`;
    snackbar.setAttribute('role', config.type === 'error' ? 'alert' : 'status');
    snackbar.setAttribute('aria-live', 'polite');

    // Icono
    const iconName = config.icon !== null ? config.icon : defaultIcons[config.type];
    if (iconName) {
      const media = document.createElement('div');
      media.className = 'rdm-snackbar--media';
      media.innerHTML = `<span class="material-symbols-rounded">${iconName}</span>`;
      snackbar.appendChild(media);
    }

    // Cuerpo con mensaje
    const body = document.createElement('div');
    body.className = 'rdm-snackbar--body';
    body.textContent = config.message;
    snackbar.appendChild(body);

    // Acciones y botón de descarte
    const hasAction = Boolean(config.actionText);
    const hasDismiss = Boolean(config.dismissible);

    if (hasAction || hasDismiss) {
      const actions = document.createElement('div');
      actions.className = 'rdm-snackbar--actions';

      if (hasAction) {
        const actionBtn = document.createElement('button');
        actionBtn.type = 'button';
        actionBtn.className = 'rdm-snackbar--action-button';
        actionBtn.textContent = config.actionText;
        actionBtn.addEventListener('click', function (e) {
          e.stopPropagation();
          if (typeof config.onAction === 'function') {
            config.onAction();
          }
          dismiss(snackbar);
        });
        actions.appendChild(actionBtn);
      }

      if (hasDismiss) {
        const closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.className = 'rdm-snackbar--close-button';
        closeBtn.setAttribute('aria-label', 'Cerrar notificación');
        closeBtn.innerHTML = '<span class="material-symbols-rounded">close</span>';
        closeBtn.addEventListener('click', function (e) {
          e.stopPropagation();
          dismiss(snackbar);
        });
        actions.appendChild(closeBtn);
      }

      snackbar.appendChild(actions);
    }

    container.appendChild(snackbar);

    // Animación de entrada
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        snackbar.classList.add('show');
      });
    });

    // Control de temporizador con pausa al hover
    let timeoutId = null;
    let remainingTime = config.duration;
    let startTime = Date.now();

    function startTimer(time) {
      if (time <= 0) return;
      startTime = Date.now();
      timeoutId = setTimeout(() => {
        dismiss(snackbar);
      }, time);
    }

    function pauseTimer() {
      if (timeoutId) {
        clearTimeout(timeoutId);
        timeoutId = null;
        remainingTime -= (Date.now() - startTime);
      }
    }

    function resumeTimer() {
      if (!timeoutId && remainingTime > 0) {
        startTimer(Math.max(remainingTime, 1500));
      }
    }

    snackbar.addEventListener('mouseenter', pauseTimer);
    snackbar.addEventListener('mouseleave', resumeTimer);

    if (config.duration > 0) {
      startTimer(config.duration);
    }

    return snackbar;
  }

  function dismiss(snackbar) {
    if (!snackbar || snackbar.classList.contains('hide')) return;
    snackbar.classList.remove('show');
    snackbar.classList.add('hide');
    setTimeout(() => {
      if (snackbar.parentNode) {
        snackbar.parentNode.removeChild(snackbar);
      }
    }, 220);
  }

  RDM.snackbar = {
    show: show,
    dismiss: dismiss
  };

  // Soporte para disparadores declarativos mediante data-snackbar-*
  function initDeclarativeTriggers() {
    document.addEventListener('click', function (event) {
      const trigger = event.target.closest('[data-snackbar-message]');
      if (!trigger) return;

      const message = trigger.getAttribute('data-snackbar-message');
      const type = trigger.getAttribute('data-snackbar-type') || 'neutral';
      const actionText = trigger.getAttribute('data-snackbar-action') || null;
      const duration = parseInt(trigger.getAttribute('data-snackbar-duration') || '4000', 10);

      show({
        message: message,
        type: type,
        actionText: actionText,
        duration: duration,
        onAction: function () {
          console.log('Acción del snackbar ejecutada:', message);
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDeclarativeTriggers);
  } else {
    initDeclarativeTriggers();
  }
})();
