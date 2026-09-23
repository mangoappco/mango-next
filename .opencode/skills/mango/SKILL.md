---
name: mango
description: Reglas y contexto permanente del proyecto ManGo! — PHP nativo MVC, arquitectura por módulos, convenciones visuales y flujo de trabajo colaborativo. Usar siempre que se trabaje en mango-next.
---

# ManGo! — Skill de Proyecto

> Esta skill debe cargarse en toda interacción con `mango-next`. Contiene las reglas no negociables y atemporales del proyecto.

## Objetivo del proyecto

Construir **ManGo! desde cero en PHP nativo**, sin arrastrar la arquitectura de la app antigua. La app vieja es solo referencia funcional y de negocio.

Intención doble:
1. **Producto**: base limpia, entendible y mantenible para gestión de negocios multi-sede.
2. **Aprendizaje**: que el código sirva como referencia didáctica de MVC paso a paso — cada avance debe ser explicable y documentado.

Stack: PHP 8+, MySQL/MariaDB, HTML/CSS/JS, Composer (solo `vlucas/phpdotenv` + `phpmailer/phpmailer`), sin framework. Entorno: XAMPP, VS Code.

## Reglas de desarrollo (obligatorias)

1. **Pasos pequeños y verificables.** Nunca cambios enormes de golpe. Un cambio = una idea verificable.
2. **Archivo por archivo.** Entender primero qué hace cada archivo antes de modificarlo.
3. **Explicación sencilla antes de cada cambio.** El usuario debe entender la estructura antes de aplicar el edit.
4. **Documentar cada avance.** No dejar el proyecto como caja negra. Commits con mensaje claro, y si hace falta, bitácora.
5. **Dinámica colaborativa:** explicar → editar → revisar → validar → siguiente. No avanzar sin validar.
6. **Desde cero, no refactorizar la app vieja.**
7. **MVC visible y simple:** `Controladores` coordinan, `Modelos` consultan con PDO preparado, `Vistas` solo presentan, `Core` centraliza servicios (Config, Database, ServicioArchivos, ServicioCorreo).
8. **Verificar con comportamiento real**, no solo lectura estática.

## Arquitectura técnica

- **Front controller único:** `public/index.php` → `Mango\Core\Application::run()`.
- **Router por `?accion=`** en `Application.php`. Todas las rutas pasan por ahí. Validar CSRF y permisos antes de delegar.
- **PSR-4:** `Mango\` → `src/`.
- **Modelos:** PDO con `ATTR_EMULATE_PREPARES=false`, consultas preparadas siempre, nunca concatenar input.
- **Seguridad existente — no romper:**
  - CSRF con `hash_equals` y `token_csrf` en todos los POST que mutan.
  - Cookies `httponly`, `SameSite=Lax`, `Secure` si HTTPS, `session.use_strict_mode=1`, `session_regenerate_id(true)` al login.
  - Timeout de sesión por `SESSION_TIMEOUT` (.env, default 1800s).
  - Contraseñas con `password_hash`/`password_verify`, nunca en claro.
  - Tokens de recuperación como SHA-256 hash, un solo uso, expiración 1h, limpieza de viejos.
  - Rate-limit persistente por correo+IP en `intentos_login`, mensajes genéricos anti-enumeración.
  - Confirmación con contraseña actual en acciones sensibles (desactivar/reactivar).
  - `registro_actividad` sin secretos; un fallo de auditoría no interrumpe el flujo.
- **Archivos:** validación MIME con `finfo` + `getimagesize`, límite 2 MB, corrección EXIF, redimensión GD, nombres `bin2hex(random_bytes(16)).jpg`, borrado compensado si falla el INSERT.
- **Schema:** `database/schema.sql` con diseño preparado para multi-sede (`usuarios`, `marcas`, `locales`, `roles`, `usuario_locales`, `recuperacion_contrasenas`, `registro_actividad`, `intentos_login`).

## Módulos y referencia

- Módulo **usuarios** como **patrón de referencia** para cualquier módulo nuevo (listar, crear, ver, editar, desactivar, reactivar, perfil propio, búsqueda).
- Nuevos módulos siguen la misma estructura: Modelo → Controlador → Vistas → ruta en `Application.php` → validación → permisos.
- Biblioteca visual propia en `componentes/` (RDM 2.0 inspirado en Material Design) + copia en `public/recursos/componentes/` — no romperla.

## Convenciones visuales y de UX (atemporales)

- **FAB:** crear → `add`, editar → `edit`, guardar → `check` (Material Symbols). Aplicar de forma consistente en todo el proyecto.
- **File inputs:** verse como controles propios, no inputs nativos. Estilo uniforme con textfields (bordes redondeados).
- **Cards de formulario:** apiladas verticalmente, no lado a lado.
- **Mensajes:** solo vía snackbar o `rdm-alert` consistente.
- **Horas:** input `type="time"` espera `HH:MM`. En BD se guardan con segundos. Normalizar en controlador con `substr($hora, 0, 5)` y validar con regex `^(?:[01]\d|2[0-3]):[0-5]\d(?:[:][0-5]\d)?$`. Si defines apertura debes definir cierre y viceversa.
- **Listados:** búsqueda por GET `?buscar=` con comodines `%texto%`, `ORDER BY id DESC`.
- **Permisos:** solo `esAdministrador()` (`tipo === 'admin'`) gestiona operaciones administrativas. Cualquier otra acción → `src/Vistas/errores/403.php`.

## Qué no hacer

- No introducir framework ni ORM.
- No concatenar SQL con input del usuario.
- No exponer hashes, tokens ni contraseñas a la vista.
- No simplificar vistas quitando CSRF o verificación de contraseña.
- No cambiar `.env` sin `.env.example`.
- No dejar carpetas de `public/uploads/` sin ignorar en `.gitignore`.

## Flujo de trabajo esperado del agente

1. Cargar esta skill al inicio de cada sesión (`skill({ name: "mango" })`).
2. Explicar el archivo/flujo antes de editar.
3. Editar un archivo o un criterio a la vez.
4. Revisar con el usuario y validar en navegador si aplica.
5. Documentar/commitar en pasos temáticos pequeños.
