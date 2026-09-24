/**
 * Switch interactions
 * Maneja el cambio de icono en switches con icon-both
 */

document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los switches con iconos en ambos estados
    const switchesIconBoth = document.querySelectorAll('.rdm-switch--container.icon-both');
    
    switchesIconBoth.forEach(container => {
        const input = container.querySelector('.rdm-switch--input');
        const icon = container.querySelector('.rdm-switch--icon');
        
        if (!input || !icon) return;
        
        // Función para actualizar el icono según el estado
        function updateIcon() {
            if (input.checked) {
                icon.textContent = 'check';
            } else {
                icon.textContent = 'close';
            }
        }
        
        // Establecer icono inicial
        updateIcon();
        
        // Actualizar icono al cambiar estado
        input.addEventListener('change', updateIcon);
    });
});
