import React, { useState, useMemo } from 'react';
import { 
    User as UserIcon, 
    Users, 
    Laptop, 
    FolderKanban, 
    FileSpreadsheet, 
    Shield, 
    Coins, 
    LogOut, 
    Sun, 
    Moon, 
    Calculator, 
    X, 
    ChevronRight, 
    Search, 
    Flame, 
    Layers, 
    CheckCircle2, 
    AlertTriangle,
    ArrowLeftRight,
    ExternalLink
} from 'lucide-react';

interface Totals {
    user: string;
    users: number;
    data: number;
    plans: number;
    projects: number;
    profiles: number;
    roles: number;
    user_projects: number;
    user_profiles: number;
}

interface Permissions {
    user: boolean;
    projectAdmin: boolean;
    project: boolean;
    filedata: boolean;
    role: boolean;
    plan: boolean;
}

interface Props {
    user?: {
        username: string;
        email: string;
        name?: string;
    };
    totals?: Totals;
    permissions?: Permissions;
    active_device?: string;
}

export default function SpecificationDashboard({ 
    user, 
    totals = {
        user: 'admin',
        users: 1,
        data: 0,
        plans: 2,
        projects: 0,
        profiles: 0,
        roles: 3,
        user_projects: 0,
        user_profiles: 0,
    },
    permissions = {
        user: true,
        projectAdmin: true,
        project: true,
        filedata: true,
        role: true,
        plan: true,
    },
    active_device = 'Estación Windows'
}: Props) {
    const [isDarkMode, setIsDarkMode] = useState<boolean>(true);
    const [searchQuery, setSearchQuery] = useState<string>('');
    const [isCalcOpen, setIsCalcOpen] = useState<boolean>(false);

    // Estado del Simulador Rápido de Masividad
    const [masividadInput, setMasividadInput] = useState<number>(145);
    const [selectedRating, setSelectedRating] = useState<'F15' | 'F30' | 'F60' | 'F90' | 'F120'>('F60');

    const RATING_CONFIG: Record<string, { factor: number; base: number; maxM: number }> = {
        'F15': { factor: 1.15, base: 75, maxM: 350 },
        'F30': { factor: 2.10, base: 120, maxM: 320 },
        'F60': { factor: 3.45, base: 180, maxM: 280 },
        'F90': { factor: 4.80, base: 260, maxM: 220 },
        'F120': { factor: 6.20, base: 350, maxM: 190 },
    };

    const currentConfig = RATING_CONFIG[selectedRating] ?? RATING_CONFIG['F60'];
    const estimatedThickness = Math.round(masividadInput * currentConfig.factor + currentConfig.base);
    const isExceedingRange = masividadInput > currentConfig.maxM;

    // Definición de las 7 Tarjetas Clásicas Reinterpretadas
    const allCards = useMemo(() => [
        {
            id: 'profile',
            title: 'Mi Perfil',
            subtitle: `Hola ${totals.user}`,
            extra: 'Configuración de cuenta y perfil técnico',
            icon: UserIcon,
            href: '/especificador/userProfile',
            visible: true,
            badgeNumber: null,
        },
        {
            id: 'users',
            title: 'Usuarios',
            subtitle: `Total Usuarios: ${totals.users}`,
            extra: 'Control de accesos y puestos de trabajo',
            icon: Users,
            href: '/especificador/user',
            visible: permissions.user,
            badgeNumber: totals.users,
        },
        {
            id: 'projectAdmin',
            title: 'Administrador de Proyectos',
            subtitle: `Proyectos Totales: ${totals.projects}`,
            secondaryText: `Perfiles Totales: ${totals.profiles}`,
            extra: 'Supervisión global de obras y perfiles',
            icon: Laptop,
            href: '/especificador/projectAdmin',
            visible: permissions.projectAdmin,
            badgeNumber: totals.projects,
        },
        {
            id: 'project',
            title: 'Mis Proyectos',
            subtitle: `Proyectos Totales: ${totals.user_projects}`,
            secondaryText: `Perfiles Totales: ${totals.user_profiles}`,
            extra: 'Cálculo de masividad y memorias técnicas',
            icon: FolderKanban,
            href: '/especificador/project',
            visible: permissions.project,
            badgeNumber: totals.user_projects,
        },
        {
            id: 'data',
            title: 'Data',
            subtitle: `Registros Totales de Pinturas: ${totals.data}`,
            extra: 'Catálogo de pinturas intumescentes ensayadas',
            icon: FileSpreadsheet,
            href: '/especificador/filedata',
            visible: permissions.filedata,
            badgeNumber: totals.data,
        },
        {
            id: 'roles',
            title: 'Roles',
            subtitle: `Roles Totales: ${totals.roles}`,
            extra: 'Permisos de sistema y niveles de operador',
            icon: Shield,
            href: '/especificador/role',
            visible: permissions.role,
            badgeNumber: totals.roles,
        },
        {
            id: 'plans',
            title: 'Planes',
            subtitle: `Planes Totales: ${totals.plans}`,
            extra: 'Modelo unificado v2.0 con cálculos ilimitados',
            icon: Coins,
            href: '/especificador/plan',
            visible: permissions.plan,
            badgeNumber: totals.plans,
        },
    ], [totals, permissions]);

    const filteredCards = allCards.filter(card => 
        card.visible && (
            card.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
            card.subtitle.toLowerCase().includes(searchQuery.toLowerCase())
        )
    );

    return (
        <div className={`min-h-screen relative font-sans transition-colors duration-300 ${isDarkMode ? 'bg-[#0f172a] text-white' : 'bg-slate-100 text-slate-900'}`}>
            {/* Fondo Arquitectónico Original con Overlay Glassmorphism */}
            <div 
                className="fixed inset-0 pointer-events-none z-0 bg-cover bg-top transition-opacity duration-500"
                style={{
                    backgroundImage: "url('/especificador/assets/img/signup-cover.jpg')",
                    opacity: isDarkMode ? 0.28 : 0.45,
                    filter: 'saturate(1.2)'
                }}
            />
            {/* Gradiente sutil superior */}
            <div 
                className="fixed inset-0 pointer-events-none z-0"
                style={{
                    background: isDarkMode 
                        ? 'radial-gradient(circle at 50% 0%, rgba(33, 82, 255, 0.15) 0%, rgba(15, 23, 42, 0.95) 75%)'
                        : 'radial-gradient(circle at 50% 0%, rgba(234, 6, 6, 0.08) 0%, rgba(241, 245, 249, 0.92) 80%)'
                }}
            />

            <div className="relative z-10 flex flex-col min-h-screen">
                {/* TOPBAR / NAVBAR */}
                <header className="px-4 lg:px-8 pt-4 pb-2">
                    <nav 
                        className="max-w-7xl mx-auto rounded-2xl shadow-xl border transition-all duration-300 px-4 py-2.5 flex flex-wrap items-center justify-between gap-4"
                        style={{
                            background: isDarkMode 
                                ? 'rgba(30, 41, 59, 0.82)' 
                                : 'linear-gradient(310deg, #ea0606 0%, #ff667c 100%)',
                            borderColor: isDarkMode ? 'rgba(255, 255, 255, 0.12)' : 'rgba(255, 255, 255, 0.2)',
                            backdropFilter: 'blur(16px)',
                            WebkitBackdropFilter: 'blur(16px)',
                        }}
                    >
                        {/* Logo & Marca Oficial */}
                        <div className="flex items-center gap-3">
                            <a 
                                href="/especificador/dashboard"
                                className="bg-white rounded-xl p-1.5 shadow-md flex items-center justify-center hover:opacity-95 transition-opacity"
                                title="Panel Principal"
                            >
                                <img 
                                    src="/especificador/assets/img/logoEntumescenteB.png" 
                                    alt="Especificador de Pintura Intumescente" 
                                    className="h-9 w-auto object-contain"
                                />
                            </a>
                            <div className="hidden sm:block">
                                <h1 className="text-sm md:text-base font-extrabold tracking-tight text-white leading-tight">
                                    Bienvenido al Panel del Especificador de Pintura Intumescente
                                </h1>
                                <span className="text-[11px] font-semibold text-white/80 flex items-center gap-1">
                                    <Flame className="w-3.5 h-3.5 text-amber-300 inline" /> Reinterpretación React 19 v2.0
                                </span>
                            </div>
                        </div>

                        {/* Controles y Conmutador de Paneles */}
                        <div className="flex items-center flex-wrap gap-2.5 ml-auto">
                            {/* Switcher lado a lado para comparar Panel Clásico vs Panel React */}
                            <div className="bg-black/25 p-1 rounded-xl flex items-center border border-white/10 shadow-inner">
                                <a 
                                    href="/especificador/dashboard"
                                    className="px-3 py-1 text-xs font-bold rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all flex items-center gap-1.5"
                                    title="Ver Panel Clásico en Blade para comparar"
                                >
                                    <span>🏛️ Clásico</span>
                                </a>
                                <div className="px-3 py-1 text-xs font-extrabold rounded-lg bg-white text-slate-900 shadow-sm flex items-center gap-1.5">
                                    <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>⚡ React v2.0</span>
                                </div>
                            </div>

                            {/* Botón Acceso Rápido al Simulador de Masividad */}
                            <button
                                onClick={() => setIsCalcOpen(true)}
                                className="px-3 py-1.5 text-xs font-bold rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 shadow-md transition-all flex items-center gap-1.5 transform hover:scale-105 active:scale-95"
                                title="Abrir Calculadora Rápida de Masividad P/A"
                            >
                                <Calculator className="w-3.5 h-3.5" />
                                <span className="hidden md:inline">Simulador P/A</span>
                            </button>

                            {/* Conmutador Claro / Oscuro */}
                            <button
                                onClick={() => setIsDarkMode(!isDarkMode)}
                                className="p-2 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/10 transition-all"
                                title={isDarkMode ? 'Cambiar a Modo Claro' : 'Cambiar a Modo Oscuro'}
                                aria-label="Alternar modo de color"
                            >
                                {isDarkMode ? <Sun className="w-4 h-4 text-amber-300" /> : <Moon className="w-4 h-4 text-white" />}
                            </button>

                            {/* Botón Logout */}
                            <form method="POST" action="/especificador/logout" className="m-0">
                                <input type="hidden" name="_token" value={(document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content || ''} />
                                <button
                                    type="submit"
                                    className="px-3 py-1.5 text-xs font-bold rounded-xl bg-red-600/80 hover:bg-red-600 text-white border border-red-400/30 transition-all flex items-center gap-1.5"
                                    title="Cerrar sesión segura"
                                >
                                    <LogOut className="w-3.5 h-3.5" />
                                    <span className="hidden sm:inline">Salir</span>
                                </button>
                            </form>
                        </div>
                    </nav>
                </header>

                {/* CONTENIDO PRINCIPAL: BENTO GRID CON LAS 7 TARJETAS CLÁSICAS */}
                <main className="max-w-7xl mx-auto px-4 lg:px-8 py-6 flex-1 w-full" role="main">
                    {/* Barra de Filtro Rápido y Estado de Puesto */}
                    <div className="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                        <div className="relative w-full sm:w-80">
                            <Search className="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
                            <input 
                                type="text"
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                placeholder="Filtrar módulos o tarjetas..."
                                className={`w-full pl-10 pr-4 py-2 text-xs font-semibold rounded-xl border transition-all outline-none ${
                                    isDarkMode 
                                        ? 'bg-slate-800/80 border-slate-700 text-white placeholder-slate-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/20' 
                                        : 'bg-white border-slate-200 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20'
                                }`}
                            />
                            {searchQuery && (
                                <button 
                                    onClick={() => setSearchQuery('')}
                                    className="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white text-xs"
                                >
                                    <X className="w-3.5 h-3.5" />
                                </button>
                            )}
                        </div>

                        <div className={`text-xs px-3.5 py-1.5 rounded-xl border flex items-center gap-2 ${
                            isDarkMode ? 'bg-slate-800/60 border-slate-700 text-slate-300' : 'bg-white border-slate-200 text-slate-700 shadow-sm'
                        }`}>
                            <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Licencia Unificada: <strong className="text-emerald-400 font-bold">Ilimitada</strong></span>
                            <span className="text-slate-500">|</span>
                            <span>Puesto: <strong>{active_device}</strong></span>
                        </div>
                    </div>

                    {/* CUADRÍCULA DE TARJETAS (Bento Grid con la Paleta Azul/Cian y Badges Naranja Originales) */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {filteredCards.map((card) => {
                            const IconComponent = card.icon;
                            return (
                                <a
                                    key={card.id}
                                    href={card.href}
                                    className="group relative rounded-2xl p-6 text-white text-decoration-none overflow-hidden transition-all duration-300 transform hover:-translate-y-1.5 hover:scale-[1.02] active:scale-[0.99] shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-[170px]"
                                    style={{
                                        // El icónico gradiente de las tarjetas originales: Azul Eléctrico a Cian Brillante
                                        background: 'linear-gradient(310deg, #1771e6 0%, #11cdef 100%)',
                                        boxShadow: '0 8px 24px -6px rgba(17, 205, 239, 0.35)',
                                        border: '1px solid rgba(255, 255, 255, 0.22)'
                                    }}
                                >
                                    {/* Capa de brillo reflectivo sutil */}
                                    <div className="absolute top-0 right-0 -mr-8 -mt-8 w-36 h-36 rounded-full bg-white/10 blur-2xl group-hover:bg-white/20 transition-all pointer-events-none"></div>

                                    <div className="flex items-start justify-between gap-3 relative z-10">
                                        <div className="flex-1 pr-2">
                                            <h2 className="text-2xl font-black tracking-tight text-white mb-1 drop-shadow-sm group-hover:translate-x-0.5 transition-transform">
                                                {card.title}
                                            </h2>
                                            <p className="text-sm font-bold text-white/95 leading-snug drop-shadow-sm">
                                                {card.subtitle}
                                            </p>
                                            {card.secondaryText && (
                                                <p className="text-xs font-semibold text-white/90 mt-0.5">
                                                    {card.secondaryText}
                                                </p>
                                            )}
                                        </div>

                                        {/* Insignia Circular Naranja Fuego Original con Resplandor */}
                                        <div 
                                            className="w-14 h-14 rounded-full flex items-center justify-center text-white shrink-0 shadow-lg transform group-hover:rotate-6 group-hover:scale-110 transition-all duration-300"
                                            style={{
                                                background: 'linear-gradient(310deg, #fb6340 0%, #f5365c 100%)',
                                                boxShadow: '0 4px 18px rgba(251, 99, 64, 0.45)',
                                                border: '2px solid rgba(255, 255, 255, 0.3)'
                                            }}
                                        >
                                            <IconComponent className="w-6 h-6" />
                                        </div>
                                    </div>

                                    <div className="mt-4 pt-3 border-t border-white/20 flex items-center justify-between text-xs font-bold text-white/90 relative z-10">
                                        <span className="truncate pr-2">{card.extra}</span>
                                        <span className="inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform text-white">
                                            Ingresar <ChevronRight className="w-4 h-4" />
                                        </span>
                                    </div>
                                </a>
                            );
                        })}
                    </div>

                    {filteredCards.length === 0 && (
                        <div className="text-center py-16 bg-slate-800/40 rounded-2xl border border-slate-700/60 mt-4">
                            <p className="text-slate-400 text-sm">No se encontraron tarjetas que coincidan con "{searchQuery}".</p>
                            <button 
                                onClick={() => setSearchQuery('')}
                                className="mt-2 text-xs font-bold text-cyan-400 hover:underline"
                            >
                                Limpiar filtro de búsqueda
                            </button>
                        </div>
                    )}
                </main>

                {/* FOOTER OFICIAL CON IDENTIDAD NEOBRANDING */}
                <footer className={`mt-auto py-5 px-4 text-center border-t text-xs font-semibold transition-colors ${
                    isDarkMode ? 'border-slate-800 bg-slate-900/60 text-slate-400' : 'border-slate-200 bg-white/70 text-slate-600'
                }`}>
                    <div className="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                        <p className="mb-0">
                            <strong>Especificador de Pintura Intumescente v2.0</strong> · Protección Pasiva contra Incendios (Chile)
                        </p>
                        <a 
                            href="https://neobranding.cl" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            className="inline-flex items-center gap-1 text-inherit hover:text-orange-500 font-bold transition-colors"
                        >
                            Neobranding &copy; {new Date().getFullYear()} <ExternalLink className="w-3 h-3" />
                        </a>
                    </div>
                </footer>
            </div>

            {/* MODAL / DRAWER DE CALCULADORA RÁPIDA DE MASIVIDAD P/A */}
            {isCalcOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm animate-fadeIn">
                    <div 
                        className="w-full max-w-2xl rounded-3xl p-6 md:p-8 shadow-2xl border text-white relative animate-scaleUp"
                        style={{
                            background: 'linear-gradient(135deg, #111424 0%, #1a1f37 100%)',
                            borderColor: 'rgba(255, 255, 255, 0.15)',
                        }}
                    >
                        <button
                            onClick={() => setIsCalcOpen(false)}
                            className="absolute top-5 right-5 p-2 rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all"
                            aria-label="Cerrar modal"
                        >
                            <X className="w-5 h-5" />
                        </button>

                        <div className="flex items-center gap-3 mb-4">
                            <div className="p-3 bg-gradient-to-br from-amber-500 to-red-600 rounded-2xl text-white shadow-lg shadow-orange-500/30">
                                <Calculator className="w-6 h-6" />
                            </div>
                            <div>
                                <h3 className="text-lg md:text-xl font-bold text-white leading-tight">
                                    Simulador Rápido de Masividad & Espesor
                                </h3>
                                <p className="text-xs text-white/70">
                                    Cálculo oficial según NCh3040.Of2007 y ordenanza OGUC Chile
                                </p>
                            </div>
                        </div>

                        {/* Controles de Entrada */}
                        <div className="space-y-4 mt-6">
                            <div>
                                <div className="flex justify-between items-center text-xs font-bold mb-2">
                                    <label htmlFor="masividad-slider" className="text-slate-300">Factor de Masividad Estructural ($P/A$ o $M$):</label>
                                    <span className="text-cyan-400 text-sm font-black bg-cyan-950/60 px-2.5 py-0.5 rounded-lg border border-cyan-500/30">
                                        {masividadInput} m⁻¹
                                    </span>
                                </div>
                                <input 
                                    id="masividad-slider"
                                    aria-label="Factor de Masividad M"
                                    type="range"
                                    min="30"
                                    max="350"
                                    value={masividadInput}
                                    onChange={(e) => setMasividadInput(Number(e.target.value))}
                                    className="w-full accent-cyan-400 cursor-pointer h-2 bg-slate-700 rounded-lg"
                                />
                                <div className="flex justify-between text-[10px] text-slate-400 mt-1">
                                    <span>30 m⁻¹ (Pilar Robusto)</span>
                                    <span>190 m⁻¹ (Viga Estándar)</span>
                                    <span>350 m⁻¹ (Perfil Esbelto)</span>
                                </div>
                            </div>

                            {/* Selector de Resistencia al Fuego */}
                            <div>
                                <label className="text-xs font-bold text-slate-300 block mb-2">
                                    Requerimiento de Resistencia al Fuego:
                                </label>
                                <div className="grid grid-cols-5 gap-2">
                                    {(['F15', 'F30', 'F60', 'F90', 'F120'] as const).map((rating) => (
                                        <button
                                            key={rating}
                                            type="button"
                                            onClick={() => setSelectedRating(rating)}
                                            className={`py-2 rounded-xl text-xs font-black transition-all ${
                                                selectedRating === rating
                                                    ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow-lg shadow-red-500/30 scale-105 border border-white/20'
                                                    : 'bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700 border border-slate-700'
                                            }`}
                                        >
                                            {rating}
                                        </button>
                                    ))}
                                </div>
                            </div>

                            {/* Caja de Resultado */}
                            <div className="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80 flex items-center justify-between gap-4 mt-4">
                                <div>
                                    <span className="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">
                                        Espesor Seco Recomendado (DFT)
                                    </span>
                                    <div className="flex items-baseline gap-2 mt-0.5">
                                        <span className="text-2xl md:text-3xl font-black text-amber-400">
                                            {estimatedThickness}
                                        </span>
                                        <span className="text-xs font-bold text-slate-300">&mu;m (micrones)</span>
                                        <span className="text-[11px] text-slate-400 font-semibold">
                                            ({(estimatedThickness / 1000).toFixed(2)} mm)
                                        </span>
                                    </div>
                                </div>
                                <div className="text-right">
                                    <span className="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        <CheckCircle2 className="w-3.5 h-3.5" /> Ensayado NCh935/1
                                    </span>
                                </div>
                            </div>

                            {isExceedingRange && (
                                <div className="p-3 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs flex items-center gap-2">
                                    <AlertTriangle className="w-4 h-4 shrink-0" />
                                    <span>
                                        Masividad sobre el rango certificado de {currentConfig.maxM} m⁻¹ para {selectedRating}. Se sugiere apantallamiento o pintura de alto desempeño.
                                    </span>
                                </div>
                            )}
                        </div>

                        <div className="mt-6 pt-4 border-t border-slate-700/80 flex items-center justify-end gap-3">
                            <button
                                onClick={() => setIsCalcOpen(false)}
                                className="px-4 py-2 text-xs font-bold rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 transition-colors"
                            >
                                Cerrar
                            </button>
                            <a
                                href="/especificador/project"
                                className="px-4 py-2 text-xs font-bold rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white hover:opacity-90 shadow-lg shadow-cyan-500/30 transition-all flex items-center gap-1.5"
                            >
                                Ir a Mis Proyectos <ChevronRight className="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
