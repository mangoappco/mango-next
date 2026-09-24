/**
 * JavaScript para ManGoApp
 * DIALOG COMPONENT (MD3)
 * Autor: Danny Estrada
 */

(function () {
  'use strict';

  function initDialogs() {
    // Abrir diálogo mediante data-dialog-target
    document.addEventListener('click', function (event) {
      const trigger = event.target.closest('[data-dialog-target]');
      if (!trigger) return;

      event.preventDefault();
      const targetSelector = trigger.getAttribute('data-dialog-target');
      const dialog = document.querySelector(
        targetSelector.startsWith('#') ? targetSelector : '#' + targetSelector
      );

      if (dialog && typeof dialog.showModal === 'function') {
        dialog.showModal();
        dialog.dispatchEvent(new CustomEvent('dialog-open', { bubbles: true, detail: { trigger } }));
      }
    });

    // Cerrar diálogo mediante data-dialog-close
    document.addEventListener('click', function (event) {
      const closeBtn = event.target.closest('[data-dialog-close]');
      if (!closeBtn) return;

      const dialog = closeBtn.closest('dialog') || (closeBtn.dataset.dialogClose ? document.querySelector(closeBtn.dataset.dialogClose) : null);
      if (dialog && typeof dialog.close === 'function' && dialog.open) {
        dialog.close();
        dialog.dispatchEvent(new CustomEvent('dialog-close', { bubbles: true, detail: { button: closeBtn } }));
      }
    });

    // Cerrar diálogo al hacer clic en el backdrop / scrim (fuera del contenedor)
    document.addEventListener('click', function (event) {
      const dialog = event.target;
      if (dialog && dialog.tagName === 'DIALOG' && dialog.classList.contains('rdm-dialog') && dialog.open) {
        const container = dialog.querySelector('.rdm-dialog--container');
        if (container) {
          const rect = container.getBoundingClientRect();
          const isInDialog = (
            event.clientX >= rect.left &&
            event.clientX <= rect.right &&
            event.clientY >= rect.top &&
            event.clientY <= rect.bottom
          );
          if (!isInDialog) {
            dialog.close();
            dialog.dispatchEvent(new CustomEvent('dialog-close', { bubbles: true, detail: { reason: 'backdrop-click' } }));
          }
        }
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDialogs);
  } else {
    initDialogs();
  }
})();
