/*
JavaScript para Search Bar
Maneja la lógica de múltiples iconos trailing, keyboard navigation, validación y eventos
*/

document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los search inputs
    const searchInputs = document.querySelectorAll('.rdm-search--control input[type="search"]');
    
    searchInputs.forEach(input => {
        const searchControl = input.closest('.rdm-search--control');
        const searchBar = searchControl.closest('.rdm-search--bar');
        const searchWrapper = input.closest('.rdm-search--wrapper');
        const trailingContainer = searchControl.querySelector('.rdm-search--trailing');
        
        if (!trailingContainer) return;
        
        // Obtener todos los botones trailing (excluyendo avatar)
        const trailingIcons = Array.from(trailingContainer.querySelectorAll('button.rdm-search--trailing-icon'));
        const closeButton = trailingIcons.find(btn => btn.querySelector('.material-symbols-rounded')?.textContent.trim() === 'close');
        
        // ===== VALIDACIÓN AUTOMÁTICA =====
        function validateSearch() {
            const value = input.value.trim();
            const hasSpecialChars = /[!@#$%^&*()+=\[\]{};':"\\|,.<>?/]/g.test(value);
            
            if (value.length > 0 && hasSpecialChars) {
                searchBar?.classList.add('has-error');
                searchWrapper?.classList.add('has-error');
                input.setAttribute('aria-invalid', 'true');
            } else {
                searchBar?.classList.remove('has-error');
                searchWrapper?.classList.remove('has-error');
                input.setAttribute('aria-invalid', 'false');
            }
        }
        
        // Si hay un botón close, manejar su visibilidad
        if (closeButton) {
            function updateClearIcon() {
                if (input.value.trim().length > 0) {
                    closeButton.classList.add('show');
                } else {
                    closeButton.classList.remove('show');
                }
            }
            
            // Ejecutar al cargar (por si hay valor por defecto)
            updateClearIcon();
            
            // Escuchar cambios en el input
            input.addEventListener('input', updateClearIcon);
            input.addEventListener('change', updateClearIcon);
            
            // Click en el icono close
            closeButton.addEventListener('click', function(e) {
                e.preventDefault();
                input.value = '';
                input.focus();
                updateClearIcon();
                validateSearch();
            });
        }
        
        // ===== KEYBOARD NAVIGATION =====
        input.addEventListener('keydown', function(e) {
            // Escape: limpiar si tiene contenido
            if (e.key === 'Escape' && input.value.trim().length > 0) {
                e.preventDefault();
                input.value = '';
                if (closeButton) {
                    closeButton.classList.remove('show');
                }
                validateSearch();
            }
            
            // Enter: buscar
            if (e.key === 'Enter') {
                e.preventDefault();
                const searchTerm = input.value.trim();
                if (searchTerm) {
                    console.log('Búsqueda:', searchTerm);
                    input.dispatchEvent(new CustomEvent('search-submit', { detail: { query: searchTerm } }));
                }
            }
        });
        
        // Validar al escribir y al blur
        input.addEventListener('input', validateSearch);
        input.addEventListener('blur', validateSearch);
        
        // Limpiar error al hacer focus
        input.addEventListener('focus', function() {
            if (input.value.trim().length === 0) {
                searchBar?.classList.remove('has-error');
                searchWrapper?.classList.remove('has-error');
                input.setAttribute('aria-invalid', 'false');
            }
        });
        
        // Manejadores para otros botones (search, voice, etc)
        trailingIcons.forEach(btn => {
            const iconText = btn.querySelector('.material-symbols-rounded')?.textContent.trim();
            
            if (iconText === 'search') {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Hacer búsqueda
                    const searchTerm = input.value.trim();
                    if (searchTerm) {
                        console.log('Buscando:', searchTerm);
                        input.dispatchEvent(new CustomEvent('search-submit', { detail: { query: searchTerm } }));
                    }
                });
            }
            
            if (iconText === 'mic') {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Iniciar reconocimiento de voz
                    console.log('Iniciando búsqueda por voz...');
                    input.dispatchEvent(new CustomEvent('voice-search-start', {}));
                });
            }
        });
        
        // Manejador para leading icon (menú)
        const leadingIcon = searchControl.querySelector('.rdm-search--leading-icon');
        if (leadingIcon) {
            leadingIcon.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Menú abierto');
                input.dispatchEvent(new CustomEvent('menu-open', {}));
            });
        }
    });
});
