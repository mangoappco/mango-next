# Mapeo Legacy → mango-next

> Referencia de por qué se migró a MVC y qué falta portar. Fuente: `C:\xampp\htdocs\proyectos\mango-legacy-reference`.

## Problemas críticos del legacy (por qué migrar)

1. **SQL Injection** — consultas concatenadas con `$_POST`/`$_GET` en `logueo_validacion.php:18`, `usuarios_agregar.php:68`, `variables_sesion.php:5`, etc.
2. **Contraseñas en texto plano** — `logueo_validacion.php:25` compara `$contrasena == $contrasena_enviada`; `usuarios_agregar.php:73` inserta sin hash.
3. **Credenciales hardcodeadas** — `logueo_validacion.php:144` SMTP `@Cococo2026`, `ipinfo.io` API key expuesta.
4. **Sin CSRF** — solo `isset($_SESSION['correo'])`, sin regeneración de ID, sin cookies `httponly`.
5. **Acoplamiento total** — `index.php` mezcla auth + permisos + dashboard + Highcharts + SQL + HTML + JS en 1642 líneas.
6. **Sin componente reutilizable** — cada CRUD copia y pega el mismo patrón.

## Mapeo de módulos

| Módulo Legacy | Estado en mango-next | Notas |
|---|---|---|
| `logueo.php` + `logueo_validacion.php` | ✅ Portado (`ControladorLogin`) | Hash, CSRF, rate-limit, anti-enumeración |
| `logueo_salir.php` | ✅ Portado (`cerrar-sesion`) | POST + CSRF |
| `cuenta_reestablecer.php` | ✅ Portado (recuperar/restablecer) | Tokens SHA-256, expiración 1h |
| `usuarios_*` (CRUD) | ✅ Portado (`ControladorUsuarios`) | Validación, prepared statements, desactivar/reactivar |
| `usuarios_permisos.php` | ⚠️ Parcial | Solo `tipo='admin'`, falta `roles`/`usuario_locales` |
| `locales_*` (CRUD) | ✅ Portado (`ControladorLocales`) | Marca, horarios, propina, imagen |
| `clientes_*` | ❌ Pendiente | No existe |
| `productos_*` + composiciones | ❌ Pendiente | No existe |
| `categorias_*`, `descuentos_*`, `impuestos_*` | ❌ Pendiente | No existe |
| `ventas_*` (POS) | ❌ Pendiente | El módulo más grande |
| `reportes_*` (20+) | ❌ Pendiente | No existe |
| `inventario_*`, `producciones_*`, `despachos_*` | ❌ Pendiente | No existe |
| `zonas_entregas_*`, `bases_*`, `cierres_*`, `gastos_*` | ❌ Pendiente | No existe |

## Lo que el nuevo heredó del legacy

- **Dominio**: usuarios, locales, marcas, roles — schema base compartido.
- **Lógica de negocio**: horarios HH:MM, propina 0-100%, tipos de local, recuperación por correo.
- **UI/UX**: RDM 2.0 reemplaza los CSS planos del legacy.
- **Multi-sede**: relación usuario-local-rol ya pensada en `usuarios_permisos`.

## Lo que el nuevo corrigió

- SQL injection → PDO prepared statements
- Contraseñas en texto plano → `password_hash`/`verify`
- Credenciales hardcodeadas → `.env`
- Sin CSRF → `token_csrf` con `hash_equals`
- Vistas mezcladas → MVC separado
- Sin rate-limit → `intentos_login` persistente
- Sin auditoría → `registro_actividad`

## Pendiente de portar (en orden de dependencia)

1. **CRUD de marcas** — bloqueado por dependencia de locales
2. **Asignación `usuario_locales` + roles** — multi-sede real
3. **CRUD de clientes** — ventas lo necesita
4. **Módulo de ventas/POS** — requiere productos/categorías/descuentos
5. **Reportes** — requiere ventas, productos, gastos
6. **Inventario, producciones, despachos, zonas de entrega**
