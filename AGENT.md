# ManGo! — Instrucciones permanentes del proyecto

> Este archivo se carga automáticamente en cada sesión. Es la fuente de verdad atemporal del proyecto. La skill `.opencode/skills/mango/SKILL.md` contiene la misma información en formato skill.

## Objetivo

Construir **ManGo! desde cero en PHP nativo**, sin arrastrar la arquitectura de la app antigua (solo referencia funcional). Doble intención: producto mantenible + referencia didáctica de MVC paso a paso. Stack: PHP 8+, MySQL, HTML/CSS/JS, Composer (`vlucas/phpdotenv` + `phpmailer/phpmailer`), sin framework. Entorno XAMPP/VS Code.

## Reglas de trabajo (obligatorias)

1. Pasos pequeños y verificables — un cambio = una idea.
2. Archivo por archivo — entender antes de modificar.
3. Explicación sencilla antes de cada edit.
4. Documentar cada avance (commit claro, bitácora si hace falta).
5. Flujo: explicar → editar → revisar → validar → siguiente.
6. MVC visible y simple: Controladores coordinan, Modelos consultan (PDO preparado), Vistas presentan, Core centraliza servicios.
7. Verificar con comportamiento real.

## Arquitectura

- Front controller: `public/index.php` → `Mango\Core\Application::run()` (router por `?accion=`).
- PSR-4 `Mango\` → `src/`.
- Modelos con `ATTR_EMULATE_PREPARES=false`, siempre prepared statements.
- Seguridad no negociable: CSRF `hash_equals`+`token_csrf`, cookies `httponly`/`SameSite=Lax`/`Secure` si HTTPS, `session.use_strict_mode=1`, `session_regenerate_id(true)`, `SESSION_TIMEOUT` (.env, 1800s), `password_hash`/`verify`, tokens SHA-256 un solo uso 1h, rate-limit por correo+IP, confirmación con contraseña actual en desactivar/reactivar, `registro_actividad` sin secretos.
- Archivos: `finfo`+`getimagesize`, 2 MB, EXIF, GD, `bin2hex(random_bytes(16)).jpg`, borrado compensado si falla INSERT.
- Schema `database/schema.sql` preparado para multi-sede.

## Módulos

- Usuarios como patrón de referencia para módulos nuevos.
- Nuevos módulos: Modelo → Controlador → Vistas → ruta en Application → validación → permisos.
- Biblioteca visual `componentes/` (RDM 2.0 Material) + copia en `public/recursos/componentes/`.

## Convenciones UX

- FAB: crear=`add`, editar=`edit`, guardar=`check` (Material Symbols) — consistente en todo el proyecto.
- File inputs como controles propios, cards apiladas, mensajes solo snackbar/`rdm-alert`.
- Horas: UI `HH:MM` (`type="time"`), BD con segundos. Normalizar `substr($hora,0,5)`, regex `^(?:[01]\d|2[0-3]):[0-5]\d(?:[:][0-5]\d)?$`, apertura y cierre van juntos o ninguno.
- Listados: `?buscar=` con `%texto%`, `ORDER BY id DESC`.
- Permisos: solo `esAdministrador()` (`tipo==='admin'`) gestiona operaciones administrativas → `403.php` si no.

## Qué no hacer

No framework/ORM, no concatenar SQL, no exponer hashes/tokens, no quitar CSRF/verificación, no cambiar `.env` sin `.env.example`, no dejar `public/uploads/` sin ignorar.

## Pruebas en navegador

Siempre verificar con Playwright usando `chromium.launch({ headless: false, slowMo: 100 })` y `DISPLAY=:0` para ventana visible en escritorio Windows.
