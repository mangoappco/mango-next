# SKILL - Sistema de Componentes RDM2

## Historial de Versiones

- **v1.7** - Componente File Input MD3: Input de archivo/imagen sin componente nativo MD3, 3 variantes (TextField File, DropZone, Button File), single/multiple, preview con chips e imagen, drag & drop, validación `accept`/`data-max-size`, estados error/disabled y API `file-selected`/`file-cleared`
- **v1.6** - Componente Snackbar MD3: Notificaciones flotantes breves (neutral, success, error, warning, info), soporte para acción interactiva, auto-dismiss con pausa en hover y API dual (declarativa y RDM.snackbar.show)
- **v1.5** - Componente Dialog MD3: Elemento nativo HTML5 dialog, 4 configuraciones (Basic, Icon, Selection, Full-screen), focus trap, backdrop animado y soporte para temas
- **v1.4.1** - Search Bar refinements: state layers removidos, leading icon cambiado a search
- **v1.4** - Search Bar 6 mejoras MD3: transiciones 160ms, keyboard nav, error states, helper text, cursor selection, active states
- **v1.3** - Search Bar MD3 compliance complete (avatar, multiple trailing icons, leading button)
- **v1.2** - Radio button normalization, z-index hierarchy
- **v1.1** - Componentes iniciales (Checkbox, Radio, Select, TextField)

---

## Search Bar Component

### Overview
Componente de búsqueda siguiendo especificaciones de Material Design 3 (MD3). Soporta 4 configuraciones de iconografía y estados completos (enabled, focused, disabled).

**Archivos**:
- [css/search.css](css/search.css) - Estilos
- [searches.php](searches.php) - Demostración
- [js/search.js](js/search.js) - Lógica interactiva

### Dimensiones (Material Design 3)
- **Alto**: 56dp (3.5em)
- **Padding horizontal**: 16dp (1em) 
- **Padding vertical**: 12dp (0.75em)
- **Leading icon**: 24dp (1.5em)
- **Trailing icons**: 24dp (1.5em) cada uno
- **Avatar**: 30dp (1.875em)
- **Border radius**: 28px
- **Gap entre iconos**: 8dp (0.5em)
- **Gap icono-avatar**: 8dp (0.5em)

### Anatomía

```
┌─────────────────────────────────────────────┐
│ 🔍                    [🎤] [🔍] [👤]      │  Leading lupa + Input + Trailing icons + Avatar
│      Buscar...                              │
│                                              │
└─────────────────────────────────────────────┘
 Search  Text Field             Voice Search + Avatar
```

**Componentes**:
1. **Leading Icon** (siempre visible): Lupa "search", botón interactivo
2. **Input**: Campo de texto nativo HTML5 search
3. **Trailing Icons** (0-2): Botones interactivos (search, voice, clear, etc.)
4. **Avatar** (opcional): Imagen circular 30dp, siempre a la derecha

### Configuraciones MD3

#### Config 1: With Avatar
- Leading icon: search (lupa)
- Input: búsqueda
- Trailing: solo avatar
- **Caso de uso**: Búsqueda con perfil de usuario visible

```html
<button class="rdm-search--leading-icon">search</button>
<input type="search">
<div class="rdm-search--trailing">
  <img class="rdm-search--avatar" src="...">
</div>
```

#### Config 2: With One Trailing Icon
- Leading icon: search (lupa)
- Input: búsqueda
- Trailing: 1 icono (search, voice o clear)
- **Caso de uso**: Búsqueda estándar con acción

```html
<button class="rdm-search--leading-icon">search</button>
<input type="search">
<div class="rdm-search--trailing">
  <button class="rdm-search--trailing-icon">search</button>
</div>
```

#### Config 3: With Two Trailing Icons
- Leading icon: search (lupa)
- Input: búsqueda
- Trailing: 2 iconos (típicamente voice + search)
- **Caso de uso**: Búsqueda avanzada con voz y texto

```html
<button class="rdm-search--leading-icon">search</button>
<input type="search">
<div class="rdm-search--trailing">
  <button class="rdm-search--trailing-icon">mic</button>
  <button class="rdm-search--trailing-icon">search</button>
</div>
```

#### Config 4: Avatar + Trailing Icon
- Leading icon: search (lupa)
- Input: búsqueda
- Trailing: 1 icono + avatar
- **Caso de uso**: Búsqueda con perfil y acciones

```html
<button class="rdm-search--leading-icon">search</button>
<input type="search">
<div class="rdm-search--trailing">
  <button class="rdm-search--trailing-icon">search</button>
  <img class="rdm-search--avatar" src="...">
</div>
```

### Colores (MD3 Tokens)

| Elemento | Light | Dark |
|----------|-------|------|
| **Fondo** | surface-container-high | surface-container-high |
| **Hover bg** | on-surface @ 0.08 | on-surface @ 0.08 |
| **Active bg** | on-surface @ 0.12 | on-surface @ 0.12 |
| **Text** | on-surface | on-surface |
| **Placeholder** | on-surface-variant | on-surface-variant |
| **Icono** | on-surface-variant | on-surface-variant |
| **Elevación** | 1 → 3 on focus | 1 → 3 on focus |

### Estados

#### Default (Enabled, Empty)
- Input vacío
- Leading icon visible e interactivo
- Trailing: solo close (hidden)
- Sin elevación especial

#### Enabled, Populated
- Input con texto
- Leading icon visible e interactivo
- Trailing: close button (shown)
- Otros trailing icons (search, voice) si están presentes

#### Focused
- Input con foco (focus-visible)
- Elevación aumenta de 1 a 3
- Outline de 2px sobre input
- State layer en leading icon si hover

#### Hover
- State layer: on-surface @ 0.08 en icono
- Para leading icon: 40dp circular background
- Para trailing icons: 40dp circular background

#### Active
- State layer: on-surface @ 0.12 en icono
- Típicamente cuando se presiona un botón

#### Disabled
- Opacidad reducida
- Leading e input deshabilitados
- No responden a eventos
- Trailing icons deshabilitados

### JavaScript API

#### Inicialización automática
```javascript
// El script se ejecuta automáticamente al cargar el DOM
// Maneja todos los .rdm-search--control inputs automáticamente
```

#### Comportamientos automáticos

1. **Toggle Clear Icon**: Botón "close" se muestra solo si input tiene contenido
2. **Clear on Click**: Hacer click en "close" limpia el input y refocaliza
3. **Keyboard Navigation**: 
   - `Escape`: Limpia el input si tiene contenido
   - `Enter`: Dispara evento `search-submit` con el query
   - `Tab`: Navegación correcta entre botones
4. **Auto-validation**: Detecta caracteres especiales y muestra error state
5. **Leading Icon**: Ejecuta lógica de menú (evento custom)
6. **Search Icon**: Ejecuta búsqueda con el contenido
7. **Voice Icon**: Inicia reconocimiento de voz

#### Eventos custom disponibles
```javascript
// Escuchar búsqueda
input.addEventListener('search-submit', (e) => {
  console.log('Query:', e.detail.query);
});

// Escuchar inicio de voz
input.addEventListener('voice-search-start', () => {
  console.log('Micrófono activado');
});

// Escuchar menú
input.addEventListener('menu-open', () => {
  console.log('Menú abierto');
});
```

### CSS Custom Properties

```css
--md-sys-color-surface-container-high: /* Color base */
--md-sys-color-on-surface: /* Texto e iconos */
--md-sys-color-on-surface-variant: /* Placeholder e iconos secundarios */

/* Elevaciones */
--md-sys-elevation-level1: /* Sombra default */
--md-sys-elevation-level3: /* Sombra focused */
```

### BEM Structure

```
.rdm-search                      /* Bloque */
├── --wrapper                    /* Contenedor exterior */
├── --container                  /* Contenedor con márgenes */
├── --bar                        /* Barra de búsqueda principal */
├── --control                    /* Control interior (flex)*/
│   ├── --leading-icon           /* Botón menú/inicio */
│   ├── input (input[type="search"])
│   └── --trailing               /* Contenedor de finales */
│       ├── --trailing-icon      /* Botón individual trailing */
│       └── --avatar             /* Imagen de perfil */
└── --support                    /* Texto de soporte */
```

### Accesibilidad

- **aria-label**: Todos los botones tienen aria-label descriptivo
- **type="search"**: Input semántico HTML5
- **:disabled**: Estado visual claro
- **:focus-visible**: Outline perceptible en navegación por teclado
- **button elements**: Semántica correcta para elementos interactivos

### Responsive

- **Min width**: 360dp (100%)
- **Max width**: 720dp (100%)
- **Adaptable**: Funciona en cualquier contenedor

### Elevation (Shadow)

- **Default**: elevation-1 (box-shadow level 1)
- **On Focus**: elevation-3 (box-shadow level 3)
- **Transición**: 160ms ease

### Transiciones

Todas las transiciones: 160ms cubic-bezier(0.2, 0, 0, 1) (MD3 standard)

- **State layer opacity**: Leading + trailing icons (0.08 hover, 0.12 active)
- **Background color**: Bar + error state
- **Elevation shadow**: 1 → 3 on focus (160ms)
- **Outline**: focus-visible en botones (160ms)
- **Color**: Helper text, disabled states (160ms)
- **Input selection**: Primary background, on-primary text
- **Cursor**: text (input), not-allowed (disabled)

### Estados Avanzados

#### Visual Refinements (v1.4.1)
- **State layers removidos**: Los círculos redondos en hover de iconos fueron eliminados para una interfaz más limpia
- **Outline y box-shadow desactivados**: `outline: none !important;` y `box-shadow: none !important;` en leading e trailing icons
- **Leading icon**: Cambio de "menu" a "search" (lupa) para consistencia semántica

#### Error State
Detectado automáticamente por caracteres especiales (!@#$%^&*+=[]{}...etc)
- **Fondo**: `color-mix(error 12%, surface-container-high)`
- **Leading icon**: Error color
- **Support text**: Error color + icono ⚠ (automático)
- **Input**: `aria-invalid="true"`
- **Trigger**: Focus limpia error si input vacío

#### Keyboard Navigation
- **Escape**: Limpia input si tiene contenido
- **Enter**: Busca con el contenido actual
- **Tab**: Navega entre elementos (native)
- **Shift+Tab**: Navega hacia atrás

#### Text Selection
- **Fondo**: `var(--md-sys-color-primary)`
- **Texto**: `var(--md-sys-color-on-primary)`
- **Cursor**: `text`
- **Caret**: Primary color

#### Disabled State
- **Opacidad**: 0.38 (MD3 standard)
- **Cursor**: `not-allowed`
- **pointer-events**: none en todos los botones
- **No responde**: A eventos

### Implementación Full HTML Example

```html
<div class="rdm-search--wrapper">
  <div class="rdm-search--container">
    <div class="rdm-search--bar">
      <div class="rdm-search--control">
        <!-- Config: Avatar + Search Icon -->
        <button class="rdm-search--leading-icon" type="button" aria-label="Menú">
          <span class="material-symbols-rounded">menu</span>
        </button>
        
        <input 
          type="search" 
          placeholder="Buscar..."
          aria-label="Campo de búsqueda"
        >
        
        <div class="rdm-search--trailing">
          <!-- Icon 1: Search -->
          <button class="rdm-search--trailing-icon show" type="button" aria-label="Buscar">
            <span class="material-symbols-rounded">search</span>
          </button>
          
          <!-- Icon 2: Avatar -->
          <img 
            class="rdm-search--avatar" 
            src="user-avatar.jpg" 
            alt="Avatar de usuario"
          >
        </div>
      </div>
    </div>
  </div>
  
  <div class="rdm-search--support">
    <span>Búsqueda con perfil de usuario</span>
  </div>
</div>
```

### Testing Checklist

- ✅ Todos los 4 configuraciones se renderizan correctamente
- ✅ Avatar redondo (border-radius: 50%) con object-fit: cover
- ✅ Leading icon es botón interactivo con state layer
- ✅ Trailing icons con gap 8dp entre ellos
- ✅ Close button se muestra solo con contenido
- ✅ Elevación aumenta en focus
- ✅ Colores match MD3 (surface-container-high)
- ✅ Estados disabled funcionan
- ✅ JavaScript maneja múltiples iconos
- ✅ Responsive 360-720dp

### Notas de Implementación

1. **Material Symbols**: Requiere fuente Material Symbols Rounded
2. **Color Tokens**: Usa tema CSS custom properties del proyecto
3. **Imagen Avatar**: Usa object-fit: cover para circular perfecto
4. **Button States**: Pseudoelementos ::before para state layer
5. **Multiple Icons**: Máximo 2 trailing icons (no incluye avatar)
6. **Clear Icon**: Dinámico based en contenido del input

---

## Dialog Component

### Overview
Componente de diálogo modal basado en las especificaciones de Material Design 3 (MD3) y montado sobre el elemento nativo HTML5 `<dialog>`. Proporciona accesibilidad integrada (focus trap, soporte Escape, ARIA) y manejo de backdrop/scrim con animaciones fluidas.

**Archivos**:
- [css/dialog.css](css/dialog.css) - Estilos y animaciones
- [dialogs.php](dialogs.php) - Demostración de las 4 variantes
- [js/dialog.js](js/dialog.js) - Lógica de interacción

### Dimensiones (Material Design 3)
- **Ancho mínimo**: 280dp (17.5em)
- **Ancho máximo**: 560dp (35em)
- **Border radius**: 28dp (1.75em)
- **Padding interno**: 24dp (1.5em)
- **Hero Icon**: 32dp (2em)
- **Gap de acciones**: 8dp (0.5em)
- **Elevación**: Nivel 3 (box-shadow level 3)

### Anatomía

```
┌─────────────────────────────────────────────┐
│                   [ ⚠️ ]                     │  Hero Icon (opcional)
│                                             │
│            ¿Eliminar producto?              │  Headline (headline-small / title-large)
│                                             │
│ Esta acción no se puede deshacer. ¿Deseas   │  Supporting text (body-medium)
│ continuar de todos modos?                   │
│                                             │
│                      [Cancelar]  [Eliminar] │  Actions (rdm-button)
└─────────────────────────────────────────────┘
```

### Configuraciones MD3

#### 1. Basic Alert Dialog
Diálogo estándar para confirmaciones y alertas sin icono decorativo.
```html
<dialog class="rdm-dialog" id="dialog-basic">
  <div class="rdm-dialog--container">
    <div class="rdm-dialog--headline">
      <h2 class="rdm-sys-typography--headline-small">Título</h2>
    </div>
    <div class="rdm-dialog--content">
      <p class="rdm-sys-typography--body-medium">Mensaje informativo.</p>
    </div>
    <div class="rdm-dialog--actions">
      <button type="button" class="rdm-button--text" data-dialog-close>Cancelar</button>
      <button type="button" class="rdm-button--text" data-dialog-close>Aceptar</button>
    </div>
  </div>
</dialog>
```

#### 2. Dialog con Icono (Hero Icon)
Diálogo centrado para advertencias, acciones críticas o informativas con icono destacado.
```html
<dialog class="rdm-dialog" id="dialog-icon">
  <div class="rdm-dialog--container">
    <div class="rdm-dialog--icon is-error">
      <span class="material-symbols-rounded">delete</span>
    </div>
    <div class="rdm-dialog--headline is-centered">
      <h2 class="rdm-sys-typography--headline-small">Eliminar elemento</h2>
    </div>
    <div class="rdm-dialog--content is-centered">
      <p class="rdm-sys-typography--body-medium">Detalle de la acción destructiva.</p>
    </div>
    <div class="rdm-dialog--actions">
      <button type="button" class="rdm-button--text" data-dialog-close>Cancelar</button>
      <button type="button" class="rdm-button--filled" data-dialog-close>Eliminar</button>
    </div>
  </div>
</dialog>
```

#### 3. Confirmation Dialog con Selección
Diálogo que incluye opciones desplazables (radio buttons o checkboxes).
```html
<dialog class="rdm-dialog" id="dialog-selection">
  <div class="rdm-dialog--container">
    <div class="rdm-dialog--headline">
      <h2 class="rdm-sys-typography--headline-small">Elige una opción</h2>
    </div>
    <div class="rdm-dialog--content rdm-dialog--content-scrollable">
      <!-- Radios / Checkboxes -->
    </div>
    <div class="rdm-dialog--actions">
      <button type="button" class="rdm-button--text" data-dialog-close>Cancelar</button>
      <button type="button" class="rdm-button--text" data-dialog-close>Guardar</button>
    </div>
  </div>
</dialog>
```

#### 4. Full-screen Dialog
Diálogo que ocupa el 100% de la pantalla para edición o formularios complejos.
```html
<dialog class="rdm-dialog rdm-dialog--fullscreen" id="dialog-fullscreen">
  <div class="rdm-dialog--container">
    <div class="rdm-dialog--fullscreen-header">
      <button type="button" class="rdm-button--text" data-dialog-close>
        <span class="material-symbols-rounded">close</span>
      </button>
      <h2 class="rdm-sys-typography--title-large">Título</h2>
      <button type="button" class="rdm-button--filled" data-dialog-close>Guardar</button>
    </div>
    <div class="rdm-dialog--fullscreen-body">
      <!-- Contenido extenso -->
    </div>
  </div>
</dialog>
```

### Colores (MD3 Tokens)

| Elemento | Token MD3 |
|---|---|
| **Fondo Contenedor** | `--md-sys-color-surface-container-high` |
| **Texto Titular** | `--md-sys-color-on-surface` |
| **Texto de Contenido** | `--md-sys-color-on-surface-variant` |
| **Icono Secundario** | `--md-sys-color-secondary` |
| **Icono de Error** | `--md-sys-color-error` |
| **Scrim (Backdrop)** | `--md-sys-color-scrim` (opacidad 0.45) |
| **Divisores** | `--md-sys-color-outline-variant` |

### BEM Structure

```
.rdm-dialog                           /* Elemento nativo <dialog> */
├── --container                       /* Contenedor central (28px border-radius) */
│   ├── --icon                        /* Icono superior (opcional) */
│   ├── --headline                    /* Titular del diálogo */
│   ├── --content                     /* Cuerpo de texto / scrollable */
│   └── --actions                     /* Barra inferior de botones */
└── --fullscreen                      /* Modificador pantalla completa */
    ├── --fullscreen-header           /* Barra superior */
    └── --fullscreen-body             /* Contenido expandido */
```

### JavaScript API

1. **Apertura declarativa:** Añadir `data-dialog-target="#idDelDialog"` a cualquier botón o enlace.
2. **Cierre declarativo:** Añadir `data-dialog-close` a cualquier botón dentro o fuera del diálogo.
3. **Cierre por Scrim:** Hacer clic fuera de `.rdm-dialog--container` cierra el diálogo automáticamente.
4. **Navegación por teclado:** La tecla `Escape` cierra nativamente el diálogo y devuelve el foco.
5. **Eventos custom:**
   - `dialog-open`: Se emite en el elemento `<dialog>` al abrir.
   - `dialog-close`: Se emite en el elemento `<dialog>` al cerrar.

---

## Snackbar Component

### Overview
Componente de notificación breve y flotante basado en las especificaciones de Material Design 3 (MD3). Emplea superficies invertidas (`inverse-surface`) para garantizar el máximo contraste y visibilidad sobre cualquier tema, con soporte para estados (neutral, success, error, warning, info), acciones interactivas y temporizador inteligente con pausa al pasar el cursor.

**Archivos**:
- [css/snackbar.css](css/snackbar.css) - Estilos y variantes de color
- [snackbars.php](snackbars.php) - Demostración interactiva
- [js/snackbar.js](js/snackbar.js) - API y lógica de animación/descarte

### Dimensiones (Material Design 3)
- **Altura mínima**: 48dp (3em)
- **Ancho mínimo**: 320dp (20em)
- **Ancho máximo**: 672dp (o 100% en pantallas móviles con margen 1em)
- **Border radius**: 8dp (0.5em)
- **Padding interno**: 12dp vertical (0.75em), 16dp horizontal (1em)
- **Icono de estado**: 24dp (1.5em)
- **Elevación**: Nivel 3 (box-shadow level 3)

### Anatomía

```
┌─────────────────────────────────────────────────────────────┐
│ [✓]  Producto guardado en el inventario   [DESHACER]  [✕]   │
└─────────────────────────────────────────────────────────────┘
  Icon   Body text                          Action      Close
```

### Configuraciones y Variantes MD3

1. **Neutral / Informativo:**
   - Superficie: `inverse-surface` con acento en color primario.
2. **Éxito (Success):**
   - Icono `check_circle` verde (#81C784) y borde lateral esmeralda (#4CAF50).
3. **Error:**
   - Icono `error` (#F2B8B5) y borde lateral de error (`--md-sys-color-error`).
4. **Advertencia (Warning):**
   - Icono `warning` (#FFB74D) y borde lateral ámbar (#FF9800).
5. **Con Botón de Acción:**
   - Incluye botón de texto interactivo para operaciones reversibles (ej. "Deshacer").

### Colores (MD3 Tokens)

| Elemento | Token MD3 |
|---|---|
| **Fondo Principal** | `--md-sys-color-inverse-surface` (`#313033` claro / `#E6E1E5` oscuro) |
| **Texto Principal** | `--md-sys-color-inverse-on-surface` (`#F4EFF4` claro / `#313033` oscuro) |
| **Botón de Acción** | `--md-sys-color-inverse-primary` (`#D0BCFF` claro / `#6750A4` oscuro) |
| **Elevación** | Nivel 3 (sombra suave multi-capa) |

### BEM Structure

```
.rdm-snackbar--wrapper                 /* Contenedor flotante fijado al pie */
└── .rdm-snackbar                      /* Tarjeta de notificación */
    ├── --media                        /* Contenedor de icono de estado */
    ├── --body                         /* Mensaje de texto principal */
    └── --actions                      /* Contenedor de acciones */
        ├── --action-button            /* Botón de acción interactivo */
        └── --close-button             /* Botón icono de descarte rápido */
```

### Modificadores de Estado
- `.rdm-snackbar--neutral`
- `.rdm-snackbar--success`
- `.rdm-snackbar--error`
- `.rdm-snackbar--warning`
- `.rdm-snackbar--info`

### JavaScript API

#### 1. Uso Declarativo (HTML)
Añadir atributos de datos a cualquier botón o disparador:
```html
<button 
  type="button" 
  data-snackbar-message="Producto guardado correctamente" 
  data-snackbar-type="success"
  data-snackbar-action="Deshacer"
  data-snackbar-duration="5000"
>
  Guardar
</button>
```

#### 2. Uso Programático (JavaScript)
```javascript
// Llamada rápida
RDM.snackbar.show('Operación completada');

// Configuración avanzada
RDM.snackbar.show({
  message: 'Elemento eliminado de la lista',
  type: 'error', // 'neutral' | 'success' | 'error' | 'warning' | 'info'
  duration: 5000, // milisegundos (0 para permanente hasta descarte)
  actionText: 'Deshacer',
  onAction: function() {
    console.log('Acción deshacer ejecutada');
  },
  dismissible: true
});
```

---

## File Input Component

### Overview
MD3 no define un componente nativo `input[type=file]`. RDM 2.0 lo compone combinando patrones oficiales de Google (Button + TextField readonly + DropZone) sobre un `<input type="file" hidden>`. Soporta subida de imágenes y archivos genéricos desde formularios, con validación, preview y drag & drop. Pensado para casos ManGo!: foto de producto, galería, ficha PDF y portafolio.

**Archivos**:
- [css/fileinput.css](css/fileinput.css) - Estilos (TextField + DropZone + chips/preview)
- [fileinputs.php](fileinputs.php) - Demostración (3 variantes, 7 ejemplos)
- [js/fileinput.js](js/fileinput.js) - Lógica de interacción y validación

### Dimensiones (Material Design 3)

- **TextField File**: 56dp alto (3.5em), padding 12dp (0.75em), iconos 24dp (1.5em), gap 16dp (1em), border-radius 4dp (0.25em), border 1dp outline
- **DropZone**: min-height 160dp (10em), padding 32dp (2em) vertical, border-radius 12dp (0.75em), borde dashed 1.5px, icono circular 48dp (3em)
- **Chips preview**: gap 8dp (0.5em), padding chip 5.6dp/12dp, icono chip 24dp, texto max 224dp (14em)
- **Imagen preview**: max-height 224dp (14em), border-radius 12dp
- **Transición**: 160ms ease (MD3 standard)

### Anatomía

```
┌────────────────────────────────────────────────────────┐
│ [🖼️]  imagen_producto.jpg          [☁️⬆️] / [✕]     │  TextField File: Leading + readonly field + trailing
│ Imagen del producto                                    │  Label flotante + helper + counter
│ PNG, JPG o WEBP — máx. 5MB              2.4 MB        │
│ [🖼️ archivo.jpg ✕] [📄 doc.pdf ✕]                     │  Chips preview
│ [━━━━━━━ Imagen preview ━━━━━━━]                       │  Imagen grande (solo single image)
└────────────────────────────────────────────────────────┘

┌────────────────────────────────────────┐
│              [☁️]                      │  DropZone: Icon + title + subtitle
│   Arrastra tu imagen aquí              │  Borde dashed, hover primary
│   o haz click para explorar            │
│   PNG, JPG, WEBP (máx. 5MB)            │
└────────────────────────────────────────┘

[☁️ Subir imagen]  [📎 Adjuntar PDF]      Button File: label[for] + hidden input
```

### Configuraciones MD3

#### 1. TextField File - Single (imagen o documento)
Campo readonly que muestra el nombre del archivo, con leading icon contextual y trailing dinámico (upload → close). Ideal dentro de `rdm-form--body`.

```html
<div class="rdm-fileinput--wrapper" data-fileinput>
  <div class="rdm-fileinput--container rdm-fileinput--outlined">
    <div class="rdm-fileinput--control">
      <div class="rdm-fileinput--leading-icon"><span class="material-symbols-rounded">image</span></div>
      <input class="rdm-fileinput--field" type="text" readonly placeholder=" " id="fi_img">
      <label class="rdm-fileinput--label" for="fi_img">Imagen del producto</label>
      <button type="button" class="rdm-fileinput--trailing-icon" data-file-trigger aria-label="Subir"><span class="material-symbols-rounded">cloud_upload</span></button>
      <button type="button" class="rdm-fileinput--trailing-icon" data-file-clear aria-label="Quitar"><span class="material-symbols-rounded">close</span></button>
    </div>
  </div>
  <div class="rdm-fileinput--support"><span class="rdm-fileinput--support-text">PNG, JPG o WEBP — máx. 5MB</span><span class="rdm-fileinput--support-counter"></span></div>
  <input type="file" class="rdm-fileinput--hidden" name="imagen" accept="image/*" data-max-size="5242880">
  <div class="rdm-fileinput--preview"></div>
  <img class="rdm-fileinput--image-preview" alt="Vista previa">
</div>
```

#### 2. TextField File - Multiple (galería)
Con `multiple` en el hidden. Muestra contador total y chips por archivo con botón de eliminación individual.

```html
<input type="file" class="rdm-fileinput--hidden" name="galeria[]" accept="image/*" multiple data-max-size="5242880">
<!-- display muestra "3 archivo(s) seleccionado(s)" y chips debajo -->
```

#### 3. DropZone - Single / Multiple
Tarjeta con borde dashed, icono circular `primary-container`, título y subtítulo. Hover y `is-dragover` cambian a `primary` con `color-mix 4%/8%`. Click o drag & drop disparan el picker. Usa el mismo hidden input y lógica de preview.

```html
<div class="rdm-fileinput--wrapper" data-fileinput>
  <div class="rdm-fileinput--dropzone" role="button" tabindex="0">
    <div class="rdm-fileinput--dropzone-icon"><span class="material-symbols-rounded">cloud_upload</span></div>
    <div class="rdm-fileinput--dropzone-title">Arrastra tu imagen aquí</div>
    <div class="rdm-fileinput--dropzone-subtitle">o haz click para explorar — PNG, JPG, WEBP (máx. 5MB)</div>
  </div>
  <input type="file" class="rdm-fileinput--hidden" name="drop_imagen" accept="image/*" data-max-size="5242880">
  <div class="rdm-fileinput--preview"></div>
  <img class="rdm-fileinput--image-preview" alt="Vista previa">
</div>
```

#### 4. Button File (variante pura MD3)
Sin wrapper. Patrón oficial Material Web: `input hidden + label` estilizado como `rdm-button`. Útil fuera de formularios (toolbars, cards).

```html
<input type="file" id="btn_file" class="rdm-fileinput--hidden" accept="image/*" data-file-display="btn_file_name">
<label for="btn_file" class="rdm-button--outlined"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">attach_file</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Adjuntar</span></div></div></label>
<span id="btn_file_name" data-placeholder="Ningún archivo seleccionado">Ningún archivo seleccionado</span>
```

### Colores (MD3 Tokens)

| Elemento | Token MD3 |
|---|---|
| **Borde Outlined** | `--md-sys-color-outline` → `on-surface` en hover → `primary` en focus + `inset 0 0 0 1px primary` |
| **Label / Helper** | `--md-sys-color-on-surface-variant` → `primary` en focus/has-file → `error` en is-error |
| **Texto archivo** | `--md-sys-color-on-surface` |
| **Fondo DropZone** | `transparent` → `color-mix(primary 4%, transparent)` hover → `color-mix(primary 8%, surface)` dragover |
| **Borde DropZone** | `outline` dashed → `primary` solid en hover/dragover → `error` en is-error |
| **Icono DropZone** | `primary-container` bg + `on-primary-container` icon |
| **Chip** | `surface-variant` bg + `on-surface-variant` text + `primary-container` icon |
| **Imagen preview border** | `--md-sys-color-outline-variant` |

### Estados

#### Default (Enabled, Empty)
- Display vacío, label centrado, trailing muestra `cloud_upload`, `close` oculto, helper visible, sin chips/imagen.

#### Has File (Populated)
- Wrapper con `.has-file`, display con nombre o "N archivo(s)", label flotante arriba (`scale 0.85`, `top -0.8em`, `primary`), trailing oculta upload y muestra close `.show`, counter con tamaño, chips generados, imagen preview si single `image/*`.

#### Focused
- `:focus-within` en outlined → `border primary + inset shadow`, label `primary`. Display y dropzone reciben `is-focused`/`focus-visible` outline.

#### Hover
- Outlined: `border on-surface`. DropZone: `border primary + bg primary 4%`. Chip remove: `bg on-surface 8%`.

#### Dragover
- DropZone con `.is-dragover`: `border primary solid + bg primary 8% + color primary`.

#### Error
- Wrapper `.is-error`: `border error`, `label/support error`, `helper` con mensaje "Archivo muy grande (X > Y)" o "Tipo no permitido". Focus mantiene `inset error`.

#### Disabled
- Wrapper `.is-disabled`: `opacity 0.65`, `pointer-events none` en dropzone y control, input `disabled`.

### BEM Structure

```
.rdm-fileinput--wrapper[data-fileinput]   /* Bloque principal, estado has-file/is-error/is-disabled */
├── --container --outlined                 /* Contenedor bordeado (TextField) */
│   └── --control                         /* Flex 56dp alto */
│       ├── --leading-icon                /* Icono contextual (image/description) */
│       ├── --field (input[readonly])     /* Display nombre archivo */
│       ├── --label (label)               /* Flotante con notch surface */
│       ├── --trailing-icon[data-file-trigger] /* Upload (cloud_upload/attach_file) */
│       └── --trailing-icon[data-file-clear]   /* Clear (close) .show con archivo */
├── --support                             /* Helper + counter */
│   ├── --support-text
│   └── --support-counter
├── --hidden (input[type=file])           /* Nativo oculto, accept/multiple/data-max-size */
├── --preview                             /* Contenedor chips */
│   └── --chip
│       ├── --chip-icon
│       ├── --chip-text
│       └── --chip-remove (button)
├── --image-preview (img)                 /* Vista previa grande .show */
└── --dropzone (opcional)                 /* Variante tarjeta dashed */
    ├── --dropzone-icon
    ├── --dropzone-title
    └── --dropzone-subtitle
```

### JavaScript API

#### Inicialización automática
```javascript
// fileinput.js se ejecuta en DOMContentLoaded y maneja todos los [data-fileinput] automáticamente
```

#### Comportamientos automáticos
1. **Trigger**: Click en display, `[data-file-trigger]` o dropzone → `hidden.click()`
2. **Sincronización**: `change` del hidden → actualiza display, counter (`formatSize`), chips, imagen preview (`FileReader`), añade `.has-file`
3. **Clear**: Click en `[data-file-clear]` o en `chip-remove` → usa `DataTransfer` para remover individual, limpia `value`, quita `.has-file`
4. **Validación**: `accept` (extensiones y `image/*`) y `data-max-size` (bytes, default 5242880) → añade `.is-error` y helper con mensaje, limpia selección
5. **Drag & Drop**: `dragenter/dragover` → `.is-dragover` en dropzone, `drop` → asigna files al hidden (respeta `multiple`)
6. **Form reset**: Limpia files, preview, chips y errores automáticamente

#### Eventos custom
```javascript
// Escuchar selección
wrapper.addEventListener('file-selected', (e) => {
  console.log('Archivos:', e.detail.files); // File[]
});
hidden.addEventListener('file-selected', (e) => { ... });

// Escuchar limpieza
wrapper.addEventListener('file-cleared', () => {
  console.log('Archivos eliminados');
});

// Variante Button con display externo
// <input data-file-display="idDelSpan">
```

#### Atributos HTML
| Atributo | Ubicación | Descripción |
|---|---|---|
| `accept` | `input[type=file]` | Filtro MD3: `image/*`, `.pdf`, `application/pdf`, `.doc` |
| `multiple` | `input[type=file]` | Permite múltiples archivos (chips) |
| `data-max-size` | `input[type=file]` | Límite bytes por archivo (ej. `5242880` = 5MB) |
| `data-fileinput` | `.rdm-fileinput--wrapper` | Marca wrapper para JS |
| `data-file-trigger` | `button` | Dispara picker |
| `data-file-clear` | `button` | Limpia selección |
| `data-file-display` | `input[type=file]` | ID de span donde mostrar nombre (variante Button) |

### Accesibilidad

- **Hidden input nativo**: Mantiene semántica `type=file` para lectores y validación de formulario `enctype=multipart/form-data`
- **Label flotante + aria-describedby**: Conectado a `support-text` para helper/error
- **Botones con aria-label**: `Subir archivo` / `Quitar archivo` en trailing icons
- **DropZone**: `role=button`, `tabindex=0`, `aria-label`, `aria-disabled`
- **Focus visible**: Outline 2px `primary` en display y dropzone
- **Teclado**: Enter/Space en dropzone dispara picker, Tab navega entre trigger/clear

### Responsive

- **Ancho**: 100% del `rdm-form--body` (max 600dp toolbar, 1400dp landing)
- **Chips**: `flex-wrap` con `max-width 14em` y `ellipsis`
- **Imagen preview**: `width 100%`, `max-height 14em`, `object-fit cover`

### Transiciones

Todas `160ms ease` (MD3):
- `border-color`, `box-shadow`, `background-color`, `color` en outlined/dropzone
- `transform` y `top` en label flotante
- `opacity` en trailing icons y preview

### Estados Avanzados

#### Validación automática
- Tipo: compara `accept` contra `file.type` y extensión
- Tamaño: `file.size > data-max-size` → error

#### Formato de tamaño
- `formatSize`: B → KB → MB con 1 decimal (ej. `2.4 MB`)

#### Integración con Reset
- `form.addEventListener('reset')` limpia `files`, preview, chips y errores con `setTimeout 0`

### Implementación Full HTML Example (Single imagen con DropZone + TextField)

```html
<form class="rdm-form--container" enctype="multipart/form-data">
  <div class="rdm-form--outlined">
    <div class="rdm-form--body">
      <div class="rdm-fileinput--wrapper" data-fileinput>
        <div class="rdm-fileinput--container rdm-fileinput--outlined">
          <div class="rdm-fileinput--control">
            <div class="rdm-fileinput--leading-icon"><span class="material-symbols-rounded">image</span></div>
            <input class="rdm-fileinput--field" type="text" readonly placeholder=" " id="fi_demo">
            <label class="rdm-fileinput--label" for="fi_demo">Imagen del producto</label>
            <button type="button" class="rdm-fileinput--trailing-icon" data-file-trigger><span class="material-symbols-rounded">cloud_upload</span></button>
            <button type="button" class="rdm-fileinput--trailing-icon" data-file-clear><span class="material-symbols-rounded">close</span></button>
          </div>
        </div>
        <div class="rdm-fileinput--support"><span class="rdm-fileinput--support-text">PNG, JPG o WEBP — máx. 5MB</span><span class="rdm-fileinput--support-counter"></span></div>
        <input type="file" class="rdm-fileinput--hidden" name="imagen" accept="image/*" data-max-size="5242880">
        <div class="rdm-fileinput--preview"></div>
        <img class="rdm-fileinput--image-preview" alt="Vista previa">
      </div>
    </div>
  </div>
</form>
```

### Testing Checklist

- ✅ TextField single muestra nombre y tamaño, label flota, trailing cambia upload→close
- ✅ TextField multiple muestra "N archivo(s)" + chips con eliminación individual (DataTransfer)
- ✅ Single image genera preview `FileReader` 224dp alto
- ✅ DropZone hover `primary 4%`, dragover `primary 8%` y dashed→solid
- ✅ Validación `accept` rechaza tipo no permitido con `.is-error`
- ✅ Validación `data-max-size` rechaza >5MB con mensaje "X > Y"
- ✅ Counter muestra "2 archivo(s) • 4.8 MB" en multiple
- ✅ Form `reset` limpia todo
- ✅ Disabled `opacity 0.65` y `pointer-events none`
- ✅ Responsive 100% y chips con ellipsis

### Notas de Implementación

1. **No estilizar el nativo**: Siempre `hidden + label/button` (patrón Material Web)
2. **Place en form**: Requiere `enctype="multipart/form-data"` y `method="post"` para envío real
3. **Dependencia**: Requiere `Material Symbols Rounded` y tokens `md/theme.css`
4. **Solo un hidden por wrapper**: Si necesitas múltiples categorías, usa múltiples wrappers
5. **Variante Button no necesita JS de wrapper**: Usa `data-file-display` para feedback

---

## Componentes Relacionados

### File Input
- **Estado**: ✅ Implementado según estándar MD3 (v1.7) - 3 variantes (TextField, DropZone, Button)
- **Ubicación**: [fileinputs.php](fileinputs.php) / [css/fileinput.css](css/fileinput.css) / [js/fileinput.js](js/fileinput.js)

### Snackbar
- **Estado**: ✅ Implementado según estándar MD3 (v1.6)
- **Ubicación**: [snackbars.php](snackbars.php) / [css/snackbar.css](css/snackbar.css) / [js/snackbar.js](js/snackbar.js)

### Dialog
- **Estado**: ✅ Implementado según estándar MD3 (v1.5)
- **Ubicación**: [dialogs.php](dialogs.php) / [css/dialog.css](css/dialog.css) / [js/dialog.js](js/dialog.js)

### Checkbox
- **Estado**: ✅ Normalizado a estándar BEM
- **Ubicación**: [checkboxes.php](checkboxes.php) / [css/checkbox.css](css/checkbox.css)

### Radio Button
- **Estado**: ✅ Normalizado a estándar Checkbox
- **Ubicación**: [radiobuttons.php](radiobuttons.php) / [css/radiobutton.css](css/radiobutton.css)

### TextField
- **Estado**: ✅ Implementado con validación
- **Ubicación**: [textfields.php](textfields.php) / [css/textfield.css](css/textfield.css)

### Select
- **Estado**: ✅ Implementado con opciones
- **Ubicación**: [selects.php](selects.php) / [css/select.css](css/select.css)

---

## Referencias

- [Material Design 3 - Search](https://m3.material.io/components/search/specs)
- [Material Design 3 - Input](https://m3.material.io/components/text-fields/specs)
- [Material Design 3 - Buttons](https://m3.material.io/components/buttons/specs) (patrón File Input: hidden + button)
- [Material Web - File Upload](https://github.com/material-components/material-web) (md-filled-button + input hidden)
- [MUI - File Upload Button](https://mui.com/material-ui/react-button/#file-upload)
- [Material Symbols Icon Set](https://fonts.google.com/icons)
