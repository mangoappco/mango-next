document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.querySelector('form.rdm-search--wrapper');
    const input = formulario?.querySelector('input[name="buscar"]');

    if (!formulario || !input) {
        return;
    }

    input.addEventListener('search-submit', function () {
        formulario.submit();
    });

    formulario.addEventListener('submit', function (event) {
        event.preventDefault();
        formulario.submit();
    });

    const botonLimpiar = formulario.querySelector('.rdm-search--trailing-icon');
    if (botonLimpiar) {
        botonLimpiar.addEventListener('click', function () {
            window.location.href = 'index.php?accion=locales';
        });
    }

    const botonBuscar = formulario.querySelector('.rdm-search--leading-icon');
    if (botonBuscar) {
        botonBuscar.addEventListener('click', function () {
            formulario.submit();
        });
    }
});
