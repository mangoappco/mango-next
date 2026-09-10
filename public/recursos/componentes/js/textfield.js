/**
 * Text Field interactions
 * Maneja mostrar/ocultar icono clear, limpiar campos y contador de caracteres
 */

document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los text fields
    const textFields = document.querySelectorAll('.rdm-textfield--control input, .rdm-textfield--control textarea');
    
    textFields.forEach(field => {
        const control = field.closest('.rdm-textfield--control');
        const trailingIcon = control.querySelector('.rdm-textfield--trailing-icon');
        
        // Función para actualizar visibilidad del icono clear
        function updateClearIcon() {
            if (!trailingIcon) return;
            
            if (field.value.length > 0) {
                trailingIcon.classList.add('show');
            } else {
                trailingIcon.classList.remove('show');
            }
        }
        
        // Mostrar/ocultar icono según contenido
        if (trailingIcon) {
            field.addEventListener('input', updateClearIcon);
            field.addEventListener('focus', updateClearIcon);
            field.addEventListener('blur', function() {
                // Delay para permitir click en el icono
                setTimeout(updateClearIcon, 150);
            });
            
            // Limpiar campo al hacer click en el icono
            trailingIcon.addEventListener('click', function() {
                field.value = '';
                field.focus();
                updateClearIcon();
                // Disparar evento input para actualizar estado del label y contador
                field.dispatchEvent(new Event('input', { bubbles: true }));
            });
            
            // Verificar estado inicial
            updateClearIcon();
        }
        
        // Contador de caracteres
        const wrapper = field.closest('.rdm-textfield--wrapper');
        if (wrapper) {
            const counter = wrapper.querySelector('[data-counter-for="' + field.id + '"]');
            if (counter) {
                const maxLength = field.getAttribute('maxlength') || 0;
                
                function updateCounter() {
                    const currentLength = field.value.length;
                    counter.textContent = currentLength + '/' + maxLength;
                }
                
                field.addEventListener('input', updateCounter);
                
                // Estado inicial
                updateCounter();
            }
        }
    });
});
