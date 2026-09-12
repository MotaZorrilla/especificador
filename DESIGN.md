---
name: Especificador de Pintura & Recubrimientos
description: Fire Protection & Structural Steel Specification Design System
colors:
  primary: "#0f172a"
  primary-dark: "#020617"
  primary-light: "#1e293b"
  accent-orange: "#ea580c"
  accent-orange-light: "#f97316"
  accent-orange-glow: "#fdba74"
  accent-red: "#dc2626"
  accent-blue: "#2563eb"
  neutral-bg: "#ffffff"
  neutral-surface: "#f8fafc"
  neutral-text: "#0f172a"
  neutral-muted: "#64748b"
  neutral-border: "#e2e8f0"
  dark-bg: "#0b0f19"
  dark-surface: "#111827"
  dark-border: "#1f2937"
typography:
  fontFamily: "'Plus Jakarta Sans', 'Inter', system-ui, sans-serif"
  monoFamily: "'JetBrains Mono', 'Fira Code', monospace"
  display:
    fontSize: "clamp(2rem, 4vw, 3rem)"
    fontWeight: 800
    lineHeight: 1.15
  headline:
    fontSize: "clamp(1.4rem, 2.5vw, 2rem)"
    fontWeight: 700
    lineHeight: 1.2
  body:
    fontSize: "0.95rem"
    fontWeight: 400
    lineHeight: 1.55
  technical-label:
    fontSize: "11px"
    fontWeight: 700
    letterSpacing: "0.05em"
rounded:
  sm: "6px"
  md: "10px"
  lg: "16px"
  full: "9999px"
---

# Design System · Especificador v2.0 Enterprise

## Overview
El sistema visual de **Especificador** transmite rigor de ingeniería estructural, certificación contra fuego y confiabilidad de grado industrial. Es un lenguaje técnico de alta densidad de información diseñado para calculistas, ingenieros civiles, proyectistas y laboratoristas que requieren exactitud milimétrica en masividades, espesores y normativas (NCh3040, OGUC).

## Colores Institucionales y Técnicos
- **Azul Acero Técnico (`#0f172a` / `#1e293b`):** Color primario institucional que representa solidez estructural, confiabilidad y precisión de cálculo.
- **Ámbar Fuego / Seguridad (`#ea580c` / `#f97316`):** Color de acento de advertencia térmica y protección pasiva contra fuego. Utilizado en insignias de retardo (F15 - F120) y estados activos.
- **Rojo Térmico Crítico (`#dc2626`):** Usado para alertas de masividades fuera de rango y advertencias de no conformidad normativa.
- **Superficies Slate (`#f8fafc`, `#ffffff`, `#e2e8f0`):** Fondos de alto contraste que maximizan la legibilidad en pantallas de oficina técnica y en condiciones de obra.

## Tipografía & Jerarquía de Datos
- **Fuente Principal:** `Plus Jakarta Sans` / `Inter`.
- **Fuente Técnica / Cómputos:** Tipografía monoespaciada para valores de masividad ($m^2/ton$), espesores en micras ($\mu m$) y fórmulas de cálculo.
- **Jerarquía:** Números destacados, tablas compactas con bordes sutiles y micro-etiquetas en mayúsculas para clasificaciones de perfiles (P4C, V4C, V3C, Abierta, Rectangular, Circular).

## Filosofía de Componentes e Interacción
- **Modales de Decisión:** Todo evento destructivo o de impacto masivo (importación, ordenamiento, truncado de base de datos) debe presentarse mediante un modal de confirmación claro con indicación de impacto.
- **Alertas Granulares:** Los procesos de importación y carga de datos deben devolver badges estructurados con el recuento de filas aceptadas y desglose de advertencias técnicas.
- **Cero Dependencia de Animaciones Pesadas:** No se emplea GSAP. Las micro-interacciones se basan exclusivamente en transiciones CSS limpias y aceleradas por hardware (`transition: all 0.2s ease`).
