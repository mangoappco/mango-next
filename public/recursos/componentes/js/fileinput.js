/**
 * File Input interactions - RDM 2.0
 * Maneja variantes: TextField file + DropZone + Button hidden
 * Patrones MD3: TextField readonly + trailing icon + DropZone dashed
 */

document.addEventListener('DOMContentLoaded', function () {

    const wrappers = document.querySelectorAll('.rdm-fileinput--wrapper[data-fileinput]');

    wrappers.forEach(wrapper => {
        const hidden = wrapper.querySelector('input[type="file"].rdm-fileinput--hidden');
        const display = wrapper.querySelector('.rdm-fileinput--field');
        const trigger = wrapper.querySelector('[data-file-trigger]');
        const clearBtn = wrapper.querySelector('[data-file-clear]');
        const supportCounter = wrapper.querySelector('.rdm-fileinput--support-counter');
        const previewContainer = wrapper.querySelector('.rdm-fileinput--preview');
        const imagePreview = wrapper.querySelector('.rdm-fileinput--image-preview');
        const supportText = wrapper.querySelector('.rdm-fileinput--support-text');
        const dropzone = wrapper.querySelector('.rdm-fileinput--dropzone');

        // Si no hay hidden, también soporta wrappers que son solo dropzone con hidden dentro
        const fileInput = hidden || wrapper.querySelector('input[type="file"]');
        if (!fileInput) return;

        const isMultiple = fileInput.hasAttribute('multiple');
        const accept = fileInput.getAttribute('accept') || '';
        const maxSizeAttr = fileInput.getAttribute('data-max-size'); // bytes
        const maxSize = maxSizeAttr ? parseInt(maxSizeAttr, 10) : 5 * 1024 * 1024; // default 5MB

        function formatSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        function setError(msg) {
            wrapper.classList.add('is-error');
            if (supportText) supportText.textContent = msg;
            if (imagePreview) imagePreview.classList.remove('show');
        }

        function clearError(defaultMsg) {
            wrapper.classList.remove('is-error');
            if (supportText && wrapper.dataset.defaultSupport) {
                supportText.textContent = wrapper.dataset.defaultSupport;
            } else if (supportText && defaultMsg) {
                supportText.textContent = defaultMsg;
            }
        }

        // Guardar mensaje soporte por defecto
        if (supportText && !wrapper.dataset.defaultSupport) {
            wrapper.dataset.defaultSupport = supportText.textContent;
        }

        function renderFiles(files) {
            const fileList = Array.from(files);

            // Validar
            for (const f of fileList) {
                if (accept && accept !== '') {
                    const accepts = accept.split(',').map(s => s.trim().toLowerCase());
                    const ok = accepts.some(a => {
                        if (a.startsWith('.')) return f.name.toLowerCase().endsWith(a);
                        if (a.endsWith('/*')) return f.type.startsWith(a.replace('/*', '/'));
                        return f.type === a;
                    });
                    if (!ok) {
                        setError('Tipo no permitido: ' + f.name);
                        fileInput.value = '';
                        updateUI([]);
                        return;
                    }
                }
                if (f.size > maxSize) {
                    setError('Archivo muy grande (' + formatSize(f.size) + ' > ' + formatSize(maxSize) + '): ' + f.name);
                    fileInput.value = '';
                    updateUI([]);
                    return;
                }
            }

            clearError();
            updateUI(fileList);

            // Evento custom
            wrapper.dispatchEvent(new CustomEvent('file-selected', { detail: { files: fileList } }));
            fileInput.dispatchEvent(new CustomEvent('file-selected', { detail: { files: fileList } }));
        }

        function updateUI(fileList) {
            const hasFile = fileList.length > 0;

            wrapper.classList.toggle('has-file', hasFile);
            if (display) {
                if (!hasFile) {
                    display.value = '';
                } else if (isMultiple) {
                    display.value = fileList.length + ' archivo(s) seleccionado(s)';
                } else {
                    display.value = fileList[0].name;
                }
                // Forzar label flotante
                display.dispatchEvent(new Event('input', { bubbles: true }));
            }

            // Clear button visibilidad
            if (clearBtn) {
                if (hasFile) clearBtn.classList.add('show');
                else clearBtn.classList.remove('show');
            }

            // Counter
            if (supportCounter) {
                if (!hasFile) supportCounter.textContent = isMultiple ? '0 archivos' : '';
                else if (isMultiple) supportCounter.textContent = fileList.length + ' archivo(s) • ' + formatSize(fileList.reduce((a, b) => a + b.size, 0));
                else supportCounter.textContent = formatSize(fileList[0].size);
            }

            // Chips preview
            if (previewContainer) {
                previewContainer.innerHTML = '';
                fileList.forEach((f, idx) => {
                    const chip = document.createElement('div');
                    chip.className = 'rdm-fileinput--chip';
                    const isImage = f.type.startsWith('image/');
                    chip.innerHTML = '<span class="rdm-fileinput--chip-icon"><span class="material-symbols-rounded">' + (isImage ? 'image' : 'description') + '</span></span>' +
                        '<span class="rdm-fileinput--chip-text">' + f.name + '</span>' +
                        '<button type="button" class="rdm-fileinput--chip-remove" aria-label="Quitar"><span class="material-symbols-rounded" style="font-size:1em">close</span></button>';
                    const btn = chip.querySelector('.rdm-fileinput--chip-remove');
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        // Remover archivo: necesita DataTransfer
                        const dt = new DataTransfer();
                        fileList.forEach((orig, i) => { if (i !== idx) dt.items.add(orig); });
                        fileInput.files = dt.files;
                        renderFiles(dt.files);
                    });
                    previewContainer.appendChild(chip);
                });
            }

            // Imagen grande solo si single image
            if (imagePreview) {
                if (hasFile && fileList.length === 1 && fileList[0].type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.add('show');
                    };
                    reader.readAsDataURL(fileList[0]);
                } else {
                    imagePreview.classList.remove('show');
                    imagePreview.removeAttribute('src');
                }
            }

            if (dropzone) {
                dropzone.classList.toggle('has-preview', hasFile);
            }
        }

        function openPicker(e) {
            if (e) e.preventDefault();
            if (wrapper.classList.contains('is-disabled')) return;
            fileInput.click();
        }

        // Trigger click -> abrir explorador
        if (trigger) trigger.addEventListener('click', openPicker);
        if (display) display.addEventListener('click', openPicker);
        if (wrapper.classList.contains('rdm-fileinput--dropzone')) {
            wrapper.addEventListener('click', openPicker);
        }
        if (dropzone) dropzone.addEventListener('click', openPicker);

        // Focus visual
        if (display) {
            display.addEventListener('focus', () => wrapper.classList.add('is-focused'));
            display.addEventListener('blur', () => wrapper.classList.remove('is-focused'));
        }

        // Clear
        if (clearBtn) {
            clearBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                fileInput.value = '';
                updateUI([]);
                clearError();
                fileInput.dispatchEvent(new CustomEvent('file-cleared'));
                wrapper.dispatchEvent(new CustomEvent('file-cleared'));
                if (display) display.focus();
            });
        }

        // Change nativo
        fileInput.addEventListener('change', function () {
            renderFiles(fileInput.files);
        });

        // Drag & Drop en dropzone / wrapper
        const dragTarget = dropzone || wrapper;
        ['dragenter', 'dragover'].forEach(evt => {
            dragTarget.addEventListener(evt, function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (wrapper.classList.contains('is-disabled')) return;
                dragTarget.classList.add('is-dragover');
            });
        });
        ['dragleave', 'drop'].forEach(evt => {
            dragTarget.addEventListener(evt, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dragTarget.classList.remove('is-dragover');
            });
        });
        dragTarget.addEventListener('drop', function (e) {
            if (wrapper.classList.contains('is-disabled')) return;
            const dt = e.dataTransfer;
            if (!dt || !dt.files || dt.files.length === 0) return;
            // Asignar al input si es posible
            if (isMultiple) {
                fileInput.files = dt.files;
                renderFiles(dt.files);
            } else {
                const dtSingle = new DataTransfer();
                dtSingle.items.add(dt.files[0]);
                fileInput.files = dtSingle.files;
                renderFiles(dtSingle.files);
            }
        });

        // Reset del form
        const form = wrapper.closest('form');
        if (form) {
            form.addEventListener('reset', function () {
                setTimeout(() => {
                    fileInput.value = '';
                    updateUI([]);
                    clearError();
                }, 0);
            });
        }

        // Estado inicial si ya tiene files (por ejemplo al volver atrás)
        if (fileInput.files && fileInput.files.length > 0) {
            renderFiles(fileInput.files);
        } else {
            updateUI([]);
        }

        // Soporte para Button File simple (label + hidden sin wrapper fileinput)
        // Se maneja aparte abajo
    });

    // Soporte para botones sueltos tipo <label for="file"> + <input hidden> sin wrapper
    document.querySelectorAll('input[type="file"].rdm-fileinput--hidden + label, label[data-file-button]').forEach(label => {
        // ya cubiertos si están dentro de wrapper
    });

    // Variante Button: mostrar nombre en elemento hermano si existe [data-file-name]
    document.querySelectorAll('input[type="file"][data-file-display]').forEach(inp => {
        const targetId = inp.getAttribute('data-file-display');
        const target = document.getElementById(targetId);
        if (!target) return;
        inp.addEventListener('change', function () {
            const f = inp.files[0];
            target.textContent = f ? f.name + ' (' + (f.size / 1024).toFixed(1) + ' KB)' : target.dataset.placeholder || 'Ningún archivo seleccionado';
        });
        const form = inp.closest('form');
        if (form) form.addEventListener('reset', () => setTimeout(() => target.textContent = target.dataset.placeholder || 'Ningún archivo seleccionado', 0));
    });
});
