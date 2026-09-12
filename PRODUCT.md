# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users
- **Ingenieros Calculistas Estructurales:** Necesitan determinar con precisión la masividad (/A$) de perfiles de acero y el espesor de pintura intumescente requerido para cumplir con la resistencia al fuego del proyecto.
- **Proyectistas y Especificadores:** Profesionales que importan cubicaciones complejas de perfiles desde planillas Excel y generan certificados de especificación técnica para la Dirección de Obras Municipales (DOM).
- **Inspectores Técnicos de Obra (ITO) y Laboratoristas:** Verifican en terreno y en laboratorio los micrajes de película seca (DFT) aplicados respecto a la masividad y la masividad crítica de los elementos.
- **Administradores del Sistema / Fabricante:** Gestionan el catálogo de pinturas, aseguran que las licencias no se compartan concurrentemente y supervisan la integridad de las especificaciones emitidas.

## Product Purpose
Proporcionar una plataforma de ingeniería estructural y química de recubrimientos de grado industrial para calcular, certificar y auditar la protección pasiva contra fuego de estructuras de acero. El sistema transforma cubicaciones estructurales complejas en especificaciones exactas de pintura intumescente (F15 a F120) conforme a las normas NCh3040 y OGUC, protegiendo al mismo tiempo los derechos de licencia mediante control estricto de sesión mono-dispositivo.

## Positioning
Frente a planillas Excel desarticuladas o herramientas genéricas sin validación técnica, **Especificador** es el motor determinista de cálculo certificado que combina algoritmos de masividad de perfiles normalizados chilenos e internacionales, importación tolerante a inconsistencias de datos, y un mecanismo de seguridad activo que previene el uso compartido no autorizado de cuentas.

## Operating Context
- Entornos de oficina de cálculo, oficinas técnicas en faena, computadores de laboratorio y tablets de inspección en obra.
- Documentos de entrada: planillas Excel de cubicación con perfiles IPN, IPE, HEA, HEB, Tubulares rectangulares/cuadrados/circulares, y canales UPN con diversas exposiciones (3 caras para vigas, 4 caras para columnas).
- Documentos de salida: certificados técnicos formales de especificación contra fuego para aprobaciones normativas y memorias de cálculo.

## Capabilities and Constraints
- **Cálculo Determinista de Masividad:** Cálculo en tiempo real según geometría del perfil y perímetro expuesto al calor (^{-1}$ o ^2/ton$).
- **Tablas de Equivalencia Térmica:** Soporte para clasificaciones F15, F30, F60, F90, F120 bajo norma NCh3040 y OGUC.
- **Importador Excel Resiliente:** Ingesta fila por fila con captura granular de errores, descarte de encabezados/filas vacías y reporte detallado de auditoría.
- **Single Device Session (Seat Kicking):** Control estricto de sesión única por usuario en middleware; el inicio de sesión en un nuevo equipo revoca inmediatamente la sesión anterior.
- **Doble Interfaz Coexistente:** Vistas Blade para flujos legacy de administración y Dashboard moderno en React 19 + TypeScript + Tailwind v4 montado en Inertia.js.

## Brand Commitments
- **Nombre:** Especificador de Pintura & Recubrimientos Técnicos (v2.0).
- **Voz y Tono:** Riguroso, exacto, profesional, sin jerga publicitaria superflua; orientado a la ingeniería civil y normas técnicas.
- **Identidad Visual:** Azul Acero Técnico (#0f172a), Naranja Seguridad Térmica (#ea580c), Rojo Alerta Estructural (#dc2626).

## Evidence on Hand
- Especificación de negocio sobre licencias intransferibles (DESAFIO_DE_NEGOCIO_LICENCIAS_INTRANSFERIBLES.pdf).
- Base de datos con tablas de perfiles y factores de masividad normalizados.
- Esquema de base de datos relacional para usuarios, proyectos, perfiles y dispositivos activos (user_devices).

## Product Principles
1. **Exactitud de Ingeniería Primero:** Los cálculos de masividad y espesores de película seca no admiten redondeos imprecisos que comprometan la seguridad estructural contra colapso por fuego.
2. **Resiliencia de Datos de Entrada:** El software no debe colapsar ante datos imperfectos; debe informar con precisión quirúrgica qué fila requiere corrección.
3. **Protección Intransferible del Valor:** Una licencia equivale a una sesión activa concurrente. El sistema defiende el modelo de negocio con elegancia y firmeza.
4. **Claridad Visual Operativa:** Diseñado bajo el modo *Operate*: densidad balanceada, contraste óptimo, números legibles a distancia de trabajo y cero distracción estética.

## Accessibility & Inclusion
- Cumplimiento WCAG 2.1 Nivel AA en contrastes de color para datos numéricos y elementos interactivos.
- Soporte completo de navegación por teclado en sliders, modales y tablas de cálculo.
- Etiquetas ARIA semánticas en indicadores de estado del dispositivo y cálculos reactivos.
