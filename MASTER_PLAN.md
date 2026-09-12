# Registro Maestro de Proyecto: Especificador de Pintura & Recubrimientos

## 📜 HISTORIAL Y TRAZABILIDAD DEL PROYECTO

### 🏛️ FASE 0: Fundación y Core Estructural v1.0 (Completado - Histórico 2023)
- [x] **Arquitectura Base:** Creación del proyecto en Laravel con autenticación y gestión de roles (`spatie/laravel-permission`).
- [x] **Modelo de Datos de Recubrimientos:** Creación de tabla `filedatas` para registro de pinturas intumescentes, certificados, masividades y factores de retardo de fuego (F15, F30, F60, F90, F120).
- [x] **Gestión de Proyectos Estructurales:** Módulos de proyectos y cálculo de perfiles de acero (`projects`, `profiles`).
- [x] **Generación de Informes Técnicos:** Exportación a PDF para especificaciones de obra bajo normas NCh3040 / OGUC.
- [x] **Esquema Inicial de Suscripción:** Tablas `plans` y control de perfiles por cuenta (`profile_count`).

### 📑 FASE HISTÓRICA: Memorándum Estratégico de Licenciamiento (Completado - 05/09/2026)
- [x] **Dossier Técnico:** Redacción y compilación del informe ejecutivo `DESAFIO_DE_NEGOCIO_LICENCIAS_INTRANSFERIBLES.pdf`.
- [x] **Análisis Comparativo:** Evaluación de 3 modelos de protección anti-sharing:
  - *Opción A:* Bloqueo de Hardware en Escritorio (HWID Lock con Tauri / NativePHP).
  - *Opción B:* Asientos Activos Web SaaS con Heartbeat y Desconexión Forzada (*Kicking*).
  - *Opción C:* Huella Digital en Navegador (Canvas/Audio Fingerprint).
- [x] **Resolución de Dirección Técnica:** Adopción del modelo **Opción B (Seat Session Kicking)** para la v2.0 web, garantizando cero falsos positivos para usuarios legítimos y eliminación del uso simultáneo.

---

## 🚀 VERSIÓN 2.0 ENTERPRISE (Septiembre 2026 - Presente)

### 🛡️ FASE 1: Limpieza, Trazabilidad y Blindaje de Entorno
- [x] **Establecimiento de Documentación:** Creación de `MASTER_PLAN.md` y `DESIGN.md` con lenguaje de diseño técnico industrial.
- [x] **Blindaje de Rutas:** Middleware de autenticación estricta y protección en todas las rutas operativas (`/dashboard`, `/project`, `/filedata`, `/report`).
- [x] **Configuración `.env` y Almacenamiento:** Consistencia de variables de entorno y enlace simbólico seguro de storage.

### 🔐 FASE 2: Sistema de Dispositivo Único (Seat Session Lock & Kicking)
- [x] **Migración `user_devices`:** Persistencia de sesiones activas, tokens de dispositivo, IP y User-Agent.
- [x] **Middleware `SingleDeviceSession`:** Detección de sesiones concurrentes e invalidación automática de la sesión previa al detectar nuevo login.
- [x] **Desacoplamiento de Planes Antiguos:** Migración al modelo de negocio de **Licencia Única Anual con Proyectos Ilimitados**.

### 📊 FASE 3: Motor de Importación Excel Resiliente y Tolerante a Fallos
- [x] **Capa de Servicio Dedicada:** Implementación de `SpecificationExcelService` y FormRequest `ImportExcelSpecificationRequest`.
- [x] **Validación Fila por Fila:** Sanitización de tipos de masividad y retardo sin interrupción por error 500.
- [x] **Auditoría y Feedback:** Reporte detallado de filas procesadas con éxito y desglose de observaciones técnicas.

### 🎨 FASE 4: Frontend v2.0 e Interfaz de Ingeniería (Estándar BoozLab)
- [x] **Consistencia Visual:** Paleta *Navy Industrial*, *Flame Safety Orange* y fondos de alto contraste.
- [x] **Modales y Micro-interacciones:** Modales accesibles para confirmaciones críticas (reseteo, ordenamiento, carga de planillas).
- [x] **Tablas Técnicas Optimizadas:** Visualización ágil de datos de masividad y certificados.

### ⚡ FASE 5: Erradicación Total de Deuda Técnica & Modernización de Stack (Completado)
- [x] **Upgrade a Laravel 11:** Migración mayor desde Laravel 9.19 a **Laravel 11.56.1** y PHPUnit 11.
- [x] **Depuración de Dependencias Obsoletas:** Remoción de `laravel-frontend-presets/argon`, `laravel/ui` y `yajra/laravel-datatables-oracle`.
- [x] **Ecosistema React 19 & TypeScript:** Instalación y compilación nativa de **React 19**, **TypeScript 5.7**, **Inertia.js v2.0** y **Lucide React**.
- [x] **Estilo de Última Generación:** Integración de **Tailwind CSS v4** con `@tailwindcss/vite` y Vite 6 (build en 3.6s).
- [x] **Resolución SSL/TLS en Windows:** Saneamiento de la cadena de certificados CA y mitigación de intercepción local.

### 💎 FASE 6: Protocolo Impeccable & Artesanía Visual de Alta Fidelidad (Completado)
- [x] **Oficialización del Protocolo 4:** Registro formal de **PROTOCOLO 4: Protocolo Impeccable (Frontend Design Impecable & Craft Floor)** en la skill global de Héctor Mota (`protocolos-antigravity`).
- [x] **Adopción de Skill Impeccable en Repositorio:** Integración de `.gemini/skills/impeccable/` dentro del proyecto especificador.
- [x] **Documento de Contexto de Producto (`PRODUCT.md`):** Formalización de audiencias (ingenieros calculistas, proyectistas, ITOs), posicionamiento determinista de ingeniería estructural, principios de diseño operativo y directrices de accesibilidad (WCAG AA).
- [x] **Craft Floor en `SpecificationDashboard.tsx`:** Modo *Operate* estricto, elevación única (sin sombras fantasma), jerarquía tipográfica sin kickers, selectores térmicos F15 a F120, slider reactivo de masividad, indicador de tolerancia técnica y matriz de verificación de perfiles estructurales tipo (HEA, IPE, Tubulares).

### 🧪 FASE 7: Batería Exhaustiva de Pruebas Automatizadas Frontend & Backend (Completado)
- [x] **Infraestructura de Pruebas Frontend:** Instalación y configuración de **Vitest**, `@testing-library/react`, `@testing-library/jest-dom` y `jsdom` con soporte nativo para React 19 y TypeScript 5.7.
- [x] **10 Pruebas Frontend Automatizadas (`SpecificationDashboard.test.tsx` - 100% PASS):**
  - Renderizado de marca técnica, badges Enterprise e indicador de estación de trabajo.
  - Visualización fidedigna de métricas de Bento Grid y modelo de licencia ilimitada.
  - Recálculo reactivo en tiempo real de espesor de película seca ($\mu m$ DFT) ante desplazamiento del slider.
  - Conmutación de marcos regulatorios (NCh3040 vs OGUC).
  - Conmutación de clasificaciones de retardo al fuego (F15, F30, F60, F90, F120) con recálculo de coeficientes.
  - Detección reactiva de masividad fuera de rango certificado ante sobrecarga térmica.
  - Verificación de límites de frontera (mínimo 30 y máximo 350 m²/ton).
  - Tolerancia y carga de valores fallback ante omisión de props.
  - Matriz de verificación de perfiles estructurales normalizados y badges de conformidad.
- [x] **25 Pruebas Backend Automatizadas (PHPUnit 11 / Laravel 11.56 - 100% PASS / 77 Aserciones):**
  - `SpecificationCalculationTest`: Fórmulas deterministas de masividad en vigas 3 caras (HEA, Tubos rectangulares), consulta de tablas F15-F120 y marcado de Fuera de Rango.
  - `AuthenticationAndRouteSecurityTest`: Bloqueo de invitados a rutas protegidas, verificación de acceso autorizado a `/dashboard` y `/react-dashboard`, y kicking inmediato por token discordante.
  - `UserDeviceModelTest`: Relaciones de Eloquent, casteo booleano de actividad, fechas y heurísticas de detección de sistemas y navegadores.
  - `ProjectManagementTest`: Creación de proyectos sin topes de licencia, persistencia segura con SoftDeletes y relación uno a muchos con perfiles.
  - `ExcelImportResilienceTest`: Rechazo de archivos ajenos, importación limpia CSV/Excel, tolerancia a filas corruptas/vacías sin error 500.
  - `SingleDeviceSessionTest`: Registro de puesto de trabajo en login y revocación de sesión concurrente.

### 🌐 FASE 8: Despliegue en Laboratorio Oficial (`lab.motazorrilla.com`) (Completado - 12/09/2026)
- [x] **Empaquetado y Distribución:** Generación de bundle de producción con dependencias de vendor, base de datos SQLite y assets compilados con Vite (`especificador_deploy.tar.gz`).
- [x] **Aislamiento en Contenedor Docker:** Despliegue en el servidor Homelab Ubuntu 24.04 LTS (`192.168.1.111`), contenedor `especificador-app` ejecutando PHP 8.3 CLI + SQLite en el puerto `8087`.
- [x] **Configuración de Reverse Proxy Nginx en `lab-gateway`:** Enrutamiento del prefijo `/especificador/` hacia `http://192.168.1.111:8087/`, preservación de cabeceras de proxy (`X-Forwarded-Host`, `X-Forwarded-Prefix`, `X-Forwarded-Proto`).
- [x] **Túnel Seguro Cloudflare:** Integración automática con el túnel Named de Cloudflare (`motazorrilla-tunnel`), sirviendo TLS 1.3 con certificados gestionados en `https://lab.motazorrilla.com/especificador/`.
- [x] **Soporte de Proxy en Laravel:** Ajuste de `TrustProxies` (`$proxies = '*'`) y configuración de `APP_URL` y `ASSET_URL` a `https://lab.motazorrilla.com/especificador`.
- [x] **Catálogo Central en Lab Hub:** Incorporación de la tarjeta técnica interactiva de **Especificador · Protección Fuego v2.0** en el dashboard principal (`https://lab.motazorrilla.com/`) con badge *Full Stack v2.0* y actualización a 11 aplicaciones activas.

---

## 📝 REGISTRO DE DECISIONES DE ARQUITECTURA (ADR)
- **ADR-001:** No sobreescritura de datos históricos. Las tablas de planes se mantienen en BD por compatibilidad retroactiva pero se desactiva la limitante en la lógica de negocio.
- **ADR-002:** Selección de Single-Session Kicking sobre Browser Fingerprinting para evitar falsos positivos causados por actualizaciones del motor Chromium.
- **ADR-003:** Adopción del estándar de ingeniería de software de BoozLab (servicios desacoplados, FormRequests dedicados y tokens de diseño en `DESIGN.md`).
- **ADR-004:** Formalización del Protocolo 4 (Impeccable) para asegurar que cualquier pantalla desarrollada posea calidad de Director de Arte y pase por pruebas automatizadas de UI en Vitest.
- **ADR-005:** Estandarización de pruebas continuas desacopladas: PHPUnit 11 en backend y Vitest en frontend, con ejecución en sub-segundos para integración continua local.
- **ADR-006:** Despliegue en sub-ruta mediante Reverse Proxy (`lab-gateway` Nginx) sobre túnel Cloudflare en puerto 8087. Resuelve el direccionamiento de assets en Laravel mediante `TrustProxies` y `ASSET_URL` explícito, permitiendo convivencia de múltiples microservicios y aplicaciones en un único dominio con TLS 1.3 de extremo a extremo.
