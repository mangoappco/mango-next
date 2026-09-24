<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<!-- Script que cambia los atributos de la top bar al hacer scroll -->
	<script src="js/topbar_scroll.js"></script>
    <script src="js/theme_toggle.js"></script>
</head>
<body>

<!-- Top bar -->
<header class="rdm-topbar--position">	

	<!-- Top bar container -->
	<div class="rdm-topbar--small-container" id="topbar">

		<!-- Top bar media -->
		<div class="rdm-topbar--media">
            <a href="index.php"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
		</div>

		<!-- Top bar body-->
		<div class="rdm-topbar--body">
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Navigation rail</div></div>
		</div>

        <!-- Top bar action-->
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

<h1 class="rdm-sys-typography--display-medium">Navigation rail</h1>

<!-- navrail -->
<div class="rdm-navrail--container">

    

    <!-- Menu -->
    <div class="rdm-navrail--destination">

        <!-- Media -->
        <div class="rdm-navrail--destination-media">                    
            <div class="rdm-badge--container">
                <div class="rdm-navrail--destination-media-icon"><span class="material-symbols-rounded">menu</span></div>
            </div>
        </div>

    </div>


    <!-- FAB -->
    <div class="rdm-navrail--destination">

        <!-- button -->
    
        <button class="rdm-button--fab">
            <div class="rdm-button--container">
                <div class="rdm-button--fab-media">
                    <div class="rdm-button--icon"><span class="material-symbols-rounded">edit</span></div>
                </div>
            </div>
        </button>
    

    </div>



    



    <!-- navrail body -->
    <div class="rdm-navrail--body">
            
        <!-- Destination -->
        <div class="rdm-navrail--destination">

            <!-- Media -->
            <div class="rdm-navrail--destination-media">
                <div class="rdm-navrail--destination-media-indicator">
                    <div class="rdm-badge--container">
                        <div class="rdm-navrail--destination-media-icon"><span class="material-symbols-rounded">storefront</span></div>
                        <div class="rdm-badge--small-badge"></div>
                    </div>
                </div>                
            </div>

            <!-- Body -->
            <div class="rdm-navrail--destination-body">
                <span class="rdm-navrail--destination-body-label-text"><span class="rdm-sys-typography--label-medium">Label</span></span>
            </div>
        </div>

        <!-- Destination -->
        <div class="rdm-navrail--destination">

            <!-- Media -->
            <div class="rdm-navrail--destination-media">
                <div class="rdm-navrail--destination-media-indicator">
                    <div class="rdm-badge--container">
                        <div class="rdm-navrail--destination-media-icon"><span class="material-symbols-rounded">shopping_bag</span></div>
                        
                    </div>
                </div>                
            </div>

            <!-- Body -->
            <div class="rdm-navrail--destination-body">
                <span class="rdm-navrail--destination-body-label-text"><span class="rdm-sys-typography--label-medium">Label</span></span>
            </div>
        </div>

        <!-- Destination -->
        <div class="rdm-navrail--destination">

            <!-- Media -->
            <div class="rdm-navrail--destination-media">
                <div class="rdm-navrail--destination-media-indicator">
                    <div class="rdm-badge--container">
                        <div class="rdm-navrail--destination-media-icon"><span class="material-symbols-rounded">receipt_long</span></div>
                        
                    </div>
                </div>                
            </div>

            <!-- Body -->
            <div class="rdm-navrail--destination-body">
                <span class="rdm-navrail--destination-body-label-text"><span class="rdm-sys-typography--label-medium">Label</span></span>
            </div>
        </div>

        <!-- Destination -->
        <div class="rdm-navrail--destination">

            <!-- Media -->
            <div class="rdm-navrail--destination-media">
                <div class="rdm-navrail--destination-media-indicator">
                    <div class="rdm-badge--container">
                        <div class="rdm-navrail--destination-media-icon"><span class="material-symbols-rounded">payments</span></div>
                        
                    </div>
                </div>                
            </div>

            <!-- Body -->
            <div class="rdm-navrail--destination-body">
                <span class="rdm-navrail--destination-body-label-text"><span class="rdm-sys-typography--label-medium">Label</span></span>
            </div>
        </div>

        <!-- Destination -->
        <div class="rdm-navrail--destination">

            <!-- Media -->
            <div class="rdm-navrail--destination-media">
                <div class="rdm-navrail--destination-media-indicator">
                    <div class="rdm-badge--container">
                        <div class="rdm-navrail--destination-media-icon"><span class="material-symbols-rounded">paid</span></div>
                        
                    </div>
                </div>                
            </div>

            <!-- Body -->
            <div class="rdm-navrail--destination-body">
                <span class="rdm-navrail--destination-body-label-text"><span class="rdm-sys-typography--label-medium">Label</span></span>
            </div>
        </div>

    </div>

</div>

<div style="height: 100vh;"></div>    

</main>

</body>
</html>