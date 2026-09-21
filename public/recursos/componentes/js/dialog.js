(function(){
	let openerButton = null;
	let activeDialog = null;
	let closeTimer = null;
	let previousHtmlOverflow = '';
	let previousBodyOverflow = '';

	function getFocusableElements(container) {
		return Array.from(container.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'))
			.filter(element => !element.hasAttribute('disabled') && element.offsetParent !== null);
	}

	function lockScroll() {
		previousHtmlOverflow = document.documentElement.style.overflow;
		previousBodyOverflow = document.body.style.overflow;
		document.documentElement.style.overflow = 'hidden';
		document.body.style.overflow = 'hidden';
		document.documentElement.classList.add('rdm-dialog-open');
		document.body.classList.add('rdm-dialog-open');
	}

	function unlockScroll() {
		document.documentElement.style.overflow = previousHtmlOverflow;
		document.body.style.overflow = previousBodyOverflow;
		document.documentElement.classList.remove('rdm-dialog-open');
		document.body.classList.remove('rdm-dialog-open');
	}

	function openDialog(dialog) {
		if (!dialog) {
			return;
		}

		activeDialog = dialog;
		openerButton = document.activeElement;
		lockScroll();
		dialog.hidden = false;
		dialog.setAttribute('aria-hidden', 'false');
		requestAnimationFrame(() => dialog.classList.add('is-open'));

		const focusableElements = getFocusableElements(dialog);
		const initialFocus = dialog.querySelector('[data-dialog-initial-focus]') || focusableElements[0];
		if (initialFocus) {
			initialFocus.focus();
		}
	}

	function closeDialog(dialog) {
		if (!dialog) {
			return;
		}

		dialog.classList.remove('is-open');
		dialog.setAttribute('aria-hidden', 'true');
		if (closeTimer) {
			clearTimeout(closeTimer);
		}
		closeTimer = setTimeout(() => {
			dialog.hidden = true;
			unlockScroll();
			if (openerButton && typeof openerButton.focus === 'function') {
				openerButton.focus();
			}
			activeDialog = null;
		}, 180);
	}

	function handleKeydown(event) {
		if (!activeDialog || activeDialog.hidden) {
			return;
		}

		if (event.key === 'Escape') {
			event.preventDefault();
			closeDialog(activeDialog);
			return;
		}

		if (event.key !== 'Tab') {
			return;
		}

		const focusableElements = getFocusableElements(activeDialog);
		if (!focusableElements.length) {
			event.preventDefault();
			return;
		}

		const firstElement = focusableElements[0];
		const lastElement = focusableElements[focusableElements.length - 1];
		const currentElement = document.activeElement;

		if (event.shiftKey && currentElement === firstElement) {
			event.preventDefault();
			lastElement.focus();
		} else if (!event.shiftKey && currentElement === lastElement) {
			event.preventDefault();
			firstElement.focus();
		}
	}

	document.addEventListener('click', function(event) {
		const openTrigger = event.target.closest('[data-dialog-open]');
		if (openTrigger) {
			const dialogId = openTrigger.getAttribute('data-dialog-open');
			openDialog(document.getElementById(dialogId));
			return;
		}

		const closeTrigger = event.target.closest('[data-dialog-close]');
		if (closeTrigger) {
			const dialog = closeTrigger.closest('.rdm-dialog--backdrop');
			closeDialog(dialog);
			return;
		}

		const backdrop = event.target.closest('.rdm-dialog--backdrop');
		if (backdrop && event.target === backdrop) {
			closeDialog(backdrop);
		}
	});

	document.addEventListener('keydown', handleKeydown);
})();