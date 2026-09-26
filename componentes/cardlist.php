<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/topbar_scroll.js"></script>
    <script src="js/theme_toggle.js"></script>
</head>
<body>

<header class="rdm-topbar--position">
	<div class="rdm-topbar--small-container" id="topbar">
		<div class="rdm-topbar--media">
			<a href="index.php"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
		</div>
		<div class="rdm-topbar--body">
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Card con lista</div></div>
		</div>
        <div class="rdm-topbar--action">
            <div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema">
                <span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span>
            </div>
            <div class="rdm-topbar--avatar" style="background-image: url(img/a1.jpg);">
                <div class="rdm-sys-typography--title-medium"></div>
            </div>
        </div>
	</div>
</header>

<main class="rdm--contenedor-toolbar">

    <h1 class="rdm-sys-typography--display-medium">Card con lista interna</h1>
    <p class="rdm-sys-typography--body-large">Permite mostrar datos estructurados (etiqueta + valor) dentro de una card sin el margen lateral del componente lista. Ideal para vistas de detalle.</p>

    <p class="rdm-sys-typography--title-medium">Uso básico: se agrega la clase rdm-card--list al contenedor de la card.</p>

    <code>&lt;div class="rdm-card--elevated rdm-card--list"&gt;</code>

    <!-- 1. Basic -->
    <h1 class="rdm-sys-typography--display-medium">1. Basic</h1>
    <p class="rdm-sys-typography--body-large">Estructura mínima: etiqueta y valor, sin media ni acción.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">
                <h2 class="rdm-sys-typography--display-small">Nombre del registro</h2>

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Marca</div>
                        <div class="rdm-list--body-suporting-text">Marca principal</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Dirección</div>
                        <div class="rdm-list--body-suporting-text">Calle 10 # 20-30</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Horario</div>
                        <div class="rdm-list--body-suporting-text">08:00 am - 6:00 pm</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 2. One-line -->
    <h1 class="rdm-sys-typography--display-medium">2. One-line</h1>
    <p class="rdm-sys-typography--body-large">Variante mínima con una sola línea de texto, ideal para datos cortos como código o estado.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">LOC-001</div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-suporting-text">Activo</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">LOC-002</div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-suporting-text">Inactivo</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 3. Card types -->
    <h1 class="rdm-sys-typography--display-medium">3. Tipos de card</h1>
    <p class="rdm-sys-typography--body-large">El modificador <code>rdm-card--list</code> es ortogonal y funciona con cualquier tipo de card.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--filled rdm-card--list">
            <div class="rdm-card--body">
                <h2 class="rdm-sys-typography--display-small">Card filled</h2>
                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Ciudad</div>
                        <div class="rdm-list--body-suporting-text">Medellín</div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article class="rdm-card--container">
        <div class="rdm-card--outlined rdm-card--list">
            <div class="rdm-card--body">
                <h2 class="rdm-sys-typography--display-small">Card outlined</h2>
                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Ciudad</div>
                        <div class="rdm-list--body-suporting-text">Bogotá</div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- 4. Leading icon -->
    <h1 class="rdm-sys-typography--display-medium">4. Leading icon</h1>
    <p class="rdm-sys-typography--body-large">Los items pueden incluir un ícono a la izquierda, igual que el componente lista.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">store</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Marca</div>
                        <div class="rdm-list--body-suporting-text">Marca principal</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">location_on</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Dirección</div>
                        <div class="rdm-list--body-suporting-text">Calle 10 # 20-30</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">schedule</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Horario</div>
                        <div class="rdm-list--body-suporting-text">08:00 am - 6:00 pm</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 5. Leading image -->
    <h1 class="rdm-sys-typography--display-medium">5. Leading image</h1>
    <p class="rdm-sys-typography--body-large">Los items pueden usar una imagen cuadrada más grande, ideal para productos o locales.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-image" style="background-image: url(img/1.jpg);"></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Sede Poblado</div>
                        <div class="rdm-list--body-suporting-text">Bogotá — Calle 10 # 20-30</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-image" style="background-image: url(img/2.jpg);"></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Sede Laureles</div>
                        <div class="rdm-list--body-suporting-text">Medellín — Carrera 43 # 1-50</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 6. Avatar -->
    <h1 class="rdm-sys-typography--display-medium">6. Avatar</h1>
    <p class="rdm-sys-typography--body-large">Los items pueden usar un avatar circular, útil para listar personas dentro de una card.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">
                <h2 class="rdm-sys-typography--display-small">Equipo asignado</h2>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--avatar" style="background-image: url(img/a1.jpg);"></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Danny Estrada</div>
                        <div class="rdm-list--body-suporting-text">Administrador</div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-suporting-text">Sede principal</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--avatar" style="background-image: url(img/a2.jpg);"></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Andrea López</div>
                        <div class="rdm-list--body-suporting-text">Cajero</div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-suporting-text">Bodega</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 7. Trailing icon -->
    <h1 class="rdm-sys-typography--display-medium">7. Trailing icon</h1>
    <p class="rdm-sys-typography--body-large">Los items pueden terminar con un ícono o texto a la derecha, igual que el componente lista.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">mail</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Correo</div>
                        <div class="rdm-list--body-suporting-text">contacto@mangoapp.co</div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-icon"><span class="material-symbols-rounded">chevron_right</span></div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">verified</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Estado</div>
                        <div class="rdm-list--body-suporting-text">Activo</div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-suporting-text">Confirmado</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 8. Three-line -->
    <h1 class="rdm-sys-typography--display-medium">8. Three-line</h1>
    <p class="rdm-sys-typography--body-large">Replica el patrón three-line del componente lista: headline, texto de apoyo largo y una tercera línea de valor.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">
                <h2 class="rdm-sys-typography--display-small">Productos destacados</h2>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-image" style="background-image: url(img/1.jpg);"></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-sys-typography--body-large"><div class="rdm-list--body-headline">Bandeja de la casa</div></div>
                        <div class="rdm-sys-typography--body-medium"><div class="rdm-list--body-suporting-text">Salmón, arroz, vegetales y acompañamiento de sopa miso.</div></div>
                        <div class="rdm-sys-typography--body-large"><div class="rdm-list--body-headline">$ 32.500</div></div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">local_fire_department</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-sys-typography--body-large"><div class="rdm-list--body-headline">Parrilla de la casa</div></div>
                        <div class="rdm-sys-typography--body-medium"><div class="rdm-list--body-suporting-text">Carnes a la parrilla, acompañadas de guarnición.</div></div>
                        <div class="rdm-sys-typography--body-large"><div class="rdm-list--body-headline">$ 41.000</div></div>
                    </div>
                    <div class="rdm-list--action">
                        <div class="rdm-list--trailing-icon"><span class="material-symbols-rounded">add_shopping_cart</span></div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 9. Divider -->
    <h1 class="rdm-sys-typography--display-medium">9. Con divisores</h1>
    <p class="rdm-sys-typography--body-large">Agrega <code>rdm-card--list--divided</code> para separar los items con una línea, más legible en listas largas.</p>

    <code>&lt;div class="rdm-card--elevated rdm-card--list rdm-card--list--divided"&gt;</code>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list rdm-card--list--divided">
            <div class="rdm-card--body">

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">person</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Danny Estrada</div>
                        <div class="rdm-list--body-suporting-text">Administrador</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">person</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Andrea López</div>
                        <div class="rdm-list--body-suporting-text">Cajero</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">person</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Javier Ramírez</div>
                        <div class="rdm-list--body-suporting-text">Mesero</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 10. Multiline values -->
    <h1 class="rdm-sys-typography--display-medium">10. Valores multilínea</h1>
    <p class="rdm-sys-typography--body-large">Los valores pueden ocupar varias líneas, por ejemplo fechas relativas con su referencia exacta.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">
            <div class="rdm-card--body">

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Creado</div>
                        <div class="rdm-list--body-suporting-text">Hace 5 días<br>(21 de Sep de 2026 a la 1:07 pm)</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Actualizado</div>
                        <div class="rdm-list--body-suporting-text">Hace 2 horas<br>(26 de Sep de 2026 a la 1:43 pm)</div>
                    </div>
                </div>

            </div>
        </div>
    </article>

    <!-- 11. Full card -->
    <h1 class="rdm-sys-typography--display-medium">11. Card completa</h1>
    <p class="rdm-sys-typography--body-large">Combinación completa: media, título, lista y acciones.</p>

    <article class="rdm-card--container">
        <div class="rdm-card--elevated rdm-card--list">

            <div class="rdm-card--media" style="background-image: url(img/1.jpg);">
                <h1 class="rdm-sys-typography--display-medium">Sede</h1>
            </div>

            <div class="rdm-card--body">
                <h2 class="rdm-sys-typography--display-small">Sede Poblado</h2>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">store</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Marca</div>
                        <div class="rdm-list--body-suporting-text">Marca principal</div>
                    </div>
                </div>

                <div class="rdm-list--container">
                    <div class="rdm-list--media">
                        <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">location_on</span></div>
                    </div>
                    <div class="rdm-list--body">
                        <div class="rdm-list--body-headline">Dirección</div>
                        <div class="rdm-list--body-suporting-text">Calle 10 # 20-30</div>
                    </div>
                </div>

            </div>

            <div class="rdm-card--action-right">
                <p>
                    <button class="rdm-button--filled"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">edit</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Editar</span></div></div></button>
                </p>
            </div>

        </div>
    </article>

</main>

</body>
</html>
