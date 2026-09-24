<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/topbar_scroll.js"></script>
    <script src="js/theme_toggle.js"></script>
    <script src="js/fileinput.js"></script>
</head>
<body>

<!-- Top bar -->
<header class="rdm-topbar--position">	
	<div class="rdm-topbar--small-container" id="topbar">
		<div class="rdm-topbar--media">
			<a href="index.php"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
		</div>
		<div class="rdm-topbar--body">
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">File Input</div></div>
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

    <h1 class="rdm-sys-typography--display-medium">File Input</h1>
    <p class="rdm-sys-typography--body-large">Componente minimalista para subir archivos e imágenes desde formularios. MD3 no tiene File Input nativo: RDM lo compone con <code>TextField readonly</code> usando <code>&lt;input type="file" hidden&gt;</code>. Versión simple con dos variantes: imagen y documento.</p>

    <!-- ================= VARIANTE 1: TEXTFIELD FILE ================= -->
    <form class="rdm-form--container" action="#" method="post" enctype="multipart/form-data" target="_self">
        <div class="rdm-form--outlined">
            <div class="rdm-form--body">

                <h2 class="rdm-sys-typography--title-large">TextField File - Single (imagen)</h2>

                <div class="rdm-fileinput--wrapper" data-fileinput id="fi_single_image">
                    <div class="rdm-fileinput--container rdm-fileinput--outlined">
                        <div class="rdm-fileinput--control">
                            <div class="rdm-fileinput--leading-icon"><span class="material-symbols-rounded">image</span></div>
                            <input class="rdm-fileinput--field" type="text" readonly placeholder=" " id="fi_single_image_display" aria-describedby="fi_single_image_help">
                            <label class="rdm-fileinput--label" for="fi_single_image_display">Imagen del producto</label>
                            <button type="button" class="rdm-fileinput--trailing-icon" data-file-trigger aria-label="Subir archivo"><span class="material-symbols-rounded">cloud_upload</span></button>
                            <button type="button" class="rdm-fileinput--trailing-icon" data-file-clear aria-label="Quitar archivo"><span class="material-symbols-rounded">close</span></button>
                        </div>
                    </div>
                    <div class="rdm-fileinput--support">
                        <span class="rdm-fileinput--support-text" id="fi_single_image_help">PNG, JPG o WEBP — máx. 5MB</span>
                        <span class="rdm-fileinput--support-counter"></span>
                    </div>
                    <input type="file" class="rdm-fileinput--hidden" id="fi_single_image_native" name="imagen_producto" accept="image/*" data-max-size="5242880">
                    <div class="rdm-fileinput--preview"></div>
                    <img class="rdm-fileinput--image-preview" alt="Vista previa">
                </div>

                <h2 class="rdm-sys-typography--title-large">TextField File - Single (documento)</h2>
                <div class="rdm-fileinput--wrapper" data-fileinput id="fi_doc">
                    <div class="rdm-fileinput--container rdm-fileinput--outlined">
                        <div class="rdm-fileinput--control">
                            <div class="rdm-fileinput--leading-icon"><span class="material-symbols-rounded">description</span></div>
                            <input class="rdm-fileinput--field" type="text" readonly placeholder=" " id="fi_doc_display" aria-describedby="fi_doc_help">
                            <label class="rdm-fileinput--label" for="fi_doc_display">Ficha técnica (PDF)</label>
                            <button type="button" class="rdm-fileinput--trailing-icon" data-file-trigger aria-label="Subir archivo"><span class="material-symbols-rounded">attach_file</span></button>
                            <button type="button" class="rdm-fileinput--trailing-icon" data-file-clear aria-label="Quitar archivo"><span class="material-symbols-rounded">close</span></button>
                        </div>
                    </div>
                    <div class="rdm-fileinput--support">
                        <span class="rdm-fileinput--support-text" id="fi_doc_help">Solo PDF — máx. 10MB</span>
                        <span class="rdm-fileinput--support-counter"></span>
                    </div>
                    <input type="file" class="rdm-fileinput--hidden" name="ficha_pdf" accept=".pdf,application/pdf" data-max-size="10485760">
                    <div class="rdm-fileinput--preview"></div>
                </div>

            </div>
            <div class="rdm-form--action-right">
                <p>
                    <button type="reset" class="rdm-button--text"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">refresh</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Limpiar</span></div></div></button>
                    <button type="submit" class="rdm-button--filled"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">send</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Enviar</span></div></div></button>
                </p>
            </div>
        </div>
    </form>



</main>

</body>
</html>
