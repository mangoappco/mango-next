<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>ManGo! - Administra tu negocio en tiempo real</title>	
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/landing.css">
	<!-- Script que cambia los atributos de la top bar al hacer scroll -->
	<script src="js/topbar_scroll.js"></script>
	<script src="js/theme_toggle.js"></script>
</head>
<body>

<!-- Top bar -->
<header class="rdm-topbar--position">	

	<!-- Top bar container -->
	<div class="rdm-topbar--small-container" id="topbar">


		<!-- Top bar brand -->
		<div class="rdm-topbar--brand">
			<div class="rdm-topbar--media">
				<div class="rdm-topbar--mango-logo"></div>
			</div>
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">ManGo!</div></div>
		</div>

		<!-- Top bar navigation -->
		<nav class="landing--topbar-links">
			<a href="#demo">Demo</a>
			<a href="#pricing">Precios</a>
		</nav>

		<!-- Top bar action-->
		<div class="rdm-topbar--action">
			<div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema">
				<span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span>
			</div>
		</div>

	</div>
	
</header>

<main class="rdm--contenedor-toolbar landing--main">

	<!-- HERO SECTION -->
	<section class="landing--hero">
		<div class="landing--hero-content">
			<h1 class="rdm-sys-typography--display-large">ManGo!</h1>
			<h2 class="rdm-sys-typography--headline-medium">Administra tu negocio desde cualquier lugar del mundo</h2>
			<p class="rdm-sys-typography--body-large">
				En tiempo real y desde cualquier dispositivo. Libérate de ataduras y dirige tu empresa con total libertad.
			</p>
			<div class="landing--hero-buttons">
				<a href="#demo" class="rdm-button--filled">
					<div class="rdm-button--container">
						<div class="rdm-button--media">
							<div class="rdm-button--icon"><span class="material-symbols-rounded">play_circle</span></div>
						</div>
						<div class="rdm-button--body">
							<span class="rdm-sys-typography--label-large">Probar Demo</span>
						</div>
					</div>
				</a>
				<a href="#pricing" class="rdm-button--outlined">
					<div class="rdm-button--container">
						<div class="rdm-button--body">
							<span class="rdm-sys-typography--label-large">Ver Precios</span>
						</div>
					</div>
				</a>
			</div>
		</div>
	</section>

	<!-- MÓDULO: VENTAS -->
	<section class="landing--section" id="ventas">
		<h2 class="rdm-sys-typography--display-medium">En ventas</h2>
		<h3 class="rdm-sys-typography--headline-large">"Vende como siempre lo has deseado"</h3>
		
		<div class="landing--cards-grid">
			
			<!-- Card 1: Punto de venta -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">shopping_cart</span>
							El punto de venta más lindo
						</h3>
						<p class="rdm-sys-typography--body-large">
							Simplifica la venta de tus productos y servicios sin complicaciones. Crea ubicaciones, mesas, cajas, habitaciones, etc.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 2: Portafolio -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">palette</span>
							Administra tu portafolio
						</h3>
						<p class="rdm-sys-typography--body-large">
							Diseña un portafolio cautivador en cuestión de minutos, incorporando con facilidad detalles para resaltar y atraer a tus clientes.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 3: Facturación -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">receipt</span>
							Facturación simple
						</h3>
						<p class="rdm-sys-typography--body-large">
							Facilita tus ventas con opciones básicas o avanzadas, como división de cuentas, propinas, reembolsos y descuentos.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 4: Métodos de pago -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">payment</span>
							Todos tus pagos
						</h3>
						<p class="rdm-sys-typography--body-large">
							Configura la mejor forma de recibir tus pagos, brindando flexibilidad a tus clientes y simplificando el cobro de tus ventas.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 5: Compatibilidad -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">devices</span>
							Compatibilidad total
						</h3>
						<p class="rdm-sys-typography--body-large">
							ManGo! se integra con todos tus dispositivos: cajones de dinero, impresoras, tabletas, celulares o computadores.
						</p>
					</div>
				</div>
			</article>

		</div>
	</section>

	<!-- MÓDULO: ADMINISTRACIÓN -->
	<section class="landing--section" id="administracion">
		<h2 class="rdm-sys-typography--display-medium">En administración</h2>
		<h3 class="rdm-sys-typography--headline-large">"Administra sin saber de administración"</h3>
		
		<div class="landing--cards-grid">
			
			<!-- Card 1: Productos y servicios -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">inventory_2</span>
							Productos y servicios
						</h3>
						<p class="rdm-sys-typography--body-large">
							Administra fácilmente productos y servicios. Crea, edita o elimina con detalles tu portafolio.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 2: Inventarios -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">storage</span>
							Control de inventarios
						</h3>
						<p class="rdm-sys-typography--body-large">
							Toma control total de tus existencias. Realiza ajustes y gestiona transferencias entre ubicaciones.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 3: Órdenes automáticas -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">shopping_bag</span>
							Órdenes automáticas
						</h3>
						<p class="rdm-sys-typography--body-large">
							Automatiza tus órdenes de compra según el comportamiento de ventas, asegurando existencias en el momento justo.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 4: Clientes -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">people</span>
							Gestión de clientes
						</h3>
						<p class="rdm-sys-typography--body-large">
							Maneja tu lista de clientes. Conoce sus hábitos de compra y fortalece tus relaciones con ellos.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 5: Empleados -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">group</span>
							Equipo de trabajo
						</h3>
						<p class="rdm-sys-typography--body-large">
							Crea cuentas de usuario, controla permisos, establece metas de ventas y sigue su desempeño.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 6: Proveedores -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">local_shipping</span>
							Gestión de proveedores
						</h3>
						<p class="rdm-sys-typography--body-large">
							Administra información de proveedores, identificando quién te ofrece los mejores precios de manera consistente.
						</p>
					</div>
				</div>
			</article>

		</div>
	</section>

	<!-- MÓDULO: REPORTES -->
	<section class="landing--section" id="reportes">
		<h2 class="rdm-sys-typography--display-medium">En reportes</h2>
		<h3 class="rdm-sys-typography--headline-large">"El poder de estar en todas partes al mismo tiempo"</h3>
		
		<div class="landing--cards-grid">
			
			<!-- Card 1: Reportes personalizados -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">analytics</span>
							Reportes personalizados
						</h3>
						<p class="rdm-sys-typography--body-large">
							Genera tus reportes con un par de toques. Obtén la información precisa que necesitas en los periodos más relevantes.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 2: Análisis de ventas -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">trending_up</span>
							Análisis de ventas
						</h3>
						<p class="rdm-sys-typography--body-large">
							Evalúa el rendimiento de tus locales, productos, servicios y personal de manera rápida y efectiva.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 3: Control de inventarios -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">table_chart</span>
							Control de movimientos
						</h3>
						<p class="rdm-sys-typography--body-large">
							Mantén un control preciso de tu inventario para decisiones más acertadas y eficientes.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 4: Cierres financieros -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">account_balance</span>
							Estados financieros
						</h3>
						<p class="rdm-sys-typography--body-large">
							Revisa diariamente un resumen de cierre, confirma pagos, verifica discrepancias y añade notas relevantes.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 5: Metas y objetivos -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">flag</span>
							Metas y objetivos
						</h3>
						<p class="rdm-sys-typography--body-large">
							Establece metas claras para tu equipo y destaca a tus mejores empleados mediante objetivos diarios o semanales.
						</p>
					</div>
				</div>
			</article>

		</div>
	</section>

	<!-- MÓDULO: CRECIMIENTO -->
	<section class="landing--section" id="crecimiento">
		<h2 class="rdm-sys-typography--display-medium">En crecimiento</h2>
		<h3 class="rdm-sys-typography--headline-large">"No le pongas límites a tus ganancias ni a tu tiempo"</h3>
		
		<div class="landing--cards-grid">
			
			<!-- Card 1: Expansión -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">trending_up</span>
							Expansión sin límites
						</h3>
						<p class="rdm-sys-typography--body-large">
							Expande tu negocio con facilidad. Clona productos, usuarios o locales de manera rápida gracias a nuestro diseño flexible.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 2: Planes flexibles -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">card_membership</span>
							Planes flexibles
						</h3>
						<p class="rdm-sys-typography--body-large">
							Libérate de contratos. Cambia fácilmente entre nuestros planes, seleccionando el que se ajuste mejor a tus necesidades.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 3: Multi-ubicación -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">store</span>
							Múltiples ubicaciones
						</h3>
						<p class="rdm-sys-typography--body-large">
							Maneja todos tus locales, incorporando nuevos puntos de venta, bodegas o adaptándote a temporadas y eventos.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 4: Centralización -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">cloud</span>
							Información centralizada
						</h3>
						<p class="rdm-sys-typography--body-large">
							Centraliza listas de precios, productos, impuestos, existencias y equipo de trabajo en todas tus tiendas sin complicaciones.
						</p>
					</div>
				</div>
			</article>

			<!-- Card 5: Alcance global -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">
							<span class="material-symbols-rounded" style="vertical-align: middle; margin-right: 8px;">public</span>
							Alcance global
						</h3>
						<p class="rdm-sys-typography--body-large">
							Crece en nuevas ciudades, estados o países. ManGo! funciona globalmente, adaptándose a diversas monedas e idiomas.
						</p>
					</div>
				</div>
			</article>

		</div>
	</section>

	<!-- SECCIÓN: PRECIOS -->
	<section class="landing--section landing--pricing" id="pricing">
		<h2 class="rdm-sys-typography--display-medium">Planes y precios</h2>
		<p class="rdm-sys-typography--body-large">Los mejores precios del mercado. Cambia de plan cuando quieras.</p>
		
		<div class="landing--pricing-container">
			
			<!-- Plan Mensual -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled landing--pricing-card">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">Plan Mensual</h3>
						<div class="landing--price">
							<span class="rdm-sys-typography--display-large">$35</span>
							<span class="rdm-sys-typography--body-large">USD/mes por punto de venta</span>
						</div>
						<ul class="landing--features">
							<li class="rdm-sys-typography--body-medium">Ventas, inventario y reportes</li>
							<li class="rdm-sys-typography--body-medium">Soporte gratuito</li>
							<li class="rdm-sys-typography--body-medium">Actualizaciones automáticas</li>
						</ul>
						<button class="rdm-button--elevated" style="width: 100%; margin-top: 16px;">
							<div class="rdm-button--container">
								<div class="rdm-button--body">
									<span class="rdm-sys-typography--label-large">Comienza ahora</span>
								</div>
							</div>
						</button>
					</div>
				</div>
			</article>

			<!-- Plan Anual -->
			<article class="rdm-card--container">
				<div class="rdm-card--filled landing--pricing-card landing--pricing-card-featured">
					<div class="landing--badge-featured">
						<span class="rdm-sys-typography--label-small">2 MESES GRATIS</span>
					</div>
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-large">Plan Anual</h3>
						<div class="landing--price">
							<span class="rdm-sys-typography--display-large">$350</span>
							<span class="rdm-sys-typography--body-large">USD/año por punto de venta</span>
						</div>
						<ul class="landing--features">
							<li class="rdm-sys-typography--body-medium">Ahorra $70 USD/año</li>
							<li class="rdm-sys-typography--body-medium">Soporte prioritario</li>
							<li class="rdm-sys-typography--body-medium">Ideal para crecimiento</li>
						</ul>
						<button class="rdm-button--filled" style="width: 100%; margin-top: 16px;">
							<div class="rdm-button--container">
								<div class="rdm-button--body">
									<span class="rdm-sys-typography--label-large">Obtén 2 meses gratis</span>
								</div>
							</div>
						</button>
					</div>
				</div>
			</article>

		</div>

		<div class="landing--pricing-note">
			<p class="rdm-sys-typography--body-large">
				<strong>El soporte y las actualizaciones son completamente gratuitas.</strong> Cada vez que tengamos nuevas actualizaciones y herramientas, las tendrás automáticamente sin pagar nada adicional y sin instalar nada.
			</p>
		</div>
	</section>

	<!-- SECCIÓN: DEMO -->
	<section class="landing--section landing--demo" id="demo">
		<div class="landing--demo-card">
			<h2 class="rdm-sys-typography--display-medium">Prueba el demo ahora</h2>
			<p class="rdm-sys-typography--body-large">Ingresa al demo en línea y conecta con todas las funciones en segundos.</p>
			<div class="landing--demo-info">
				<div class="landing--demo-item">
					<span class="rdm-sys-typography--label-large">URL</span>
					<a href="https://www.mangoapp.co/demo_cafes" target="_blank">www.mangoapp.co/demo_cafes</a>
				</div>
				<div class="landing--demo-item">
					<span class="rdm-sys-typography--label-large">Correo</span>
					<span>demo@demo.com</span>
				</div>
				<div class="landing--demo-item">
					<span class="rdm-sys-typography--label-large">Contraseña</span>
					<span>demo</span>
				</div>
			</div>
			<a href="https://www.mangoapp.co/demo_cafes" target="_blank" class="rdm-button--filled landing--demo-button">
				<div class="rdm-button--container">
					<div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Abrir demo</span></div>
				</div>
			</a>
		</div>
	</section>

	<!-- CTA -->
	<section class="landing--cta">
		<div class="landing--cta-body">
			<div>
				<h2 class="rdm-sys-typography--display-medium">Un solo lugar para tu negocio</h2>
				<p class="rdm-sys-typography--body-large">ManGo! te ayuda a vender, administrar y crecer sin perder tiempo en sistemas complicados.</p>
			</div>
			<a href="#demo" class="rdm-button--filled landing--cta-button">
				<div class="rdm-button--container">
					<div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Probar demo gratis</span></div>
				</div>
			</a>
		</div>
	</section>

</main>


<!-- Footer -->
<footer class="landing--footer">
	<div class="landing--footer-content">
		<div class="landing--footer-section">
			<h3 class="rdm-sys-typography--title-medium">ManGo!</h3>
			<p class="rdm-sys-typography--body-small">
				La solución integral para administrar tu negocio desde cualquier lugar del mundo.
			</p>
		</div>

		<div class="landing--footer-section">
			<h3 class="rdm-sys-typography--title-medium">Contacto</h3>
			<p class="rdm-sys-typography--body-small">
				<strong>Danny Wayne Estrada</strong><br>
				Fundador y CEO de ManGo! App<br>
				Medellín - Colombia
			</p>
			<div class="landing--footer-contact">
				<a href="http://www.mangoapp.co" class="rdm-sys-typography--body-small" target="_blank">
					🌐 www.mangoapp.co
				</a>
				<a href="https://wa.me/573003144886" class="rdm-sys-typography--body-small" target="_blank">
					💬 WhatsApp +573003144886
				</a>
			</div>
		</div>

	</div>

	<div class="landing--footer-bottom">
		<p class="rdm-sys-typography--body-small">
			© 2026 ManGo! App. Todos los derechos reservados.
		</p>
	</div>
</footer>

</body>
</html>
