import React, { useState } from 'react';
import { 
    ShieldCheck, 
    Flame, 
    Layers, 
    FileSpreadsheet, 
    Activity, 
    Laptop, 
    CheckCircle2, 
    AlertTriangle,
    Calculator
} from 'lucide-react';

interface Props {
    user?: {
        username: string;
        email: string;
    };
    stats?: {
        paints_count: number;
        projects_count: number;
        profiles_count: number;
        active_device: string;
    };
}

export default function SpecificationDashboard({ user, stats }: Props) {
    const [masividadInput, setMasividadInput] = useState<number>(125);
    const [selectedStandard, setSelectedStandard] = useState<'NCh3040' | 'OGUC'>('NCh3040');
    const [selectedRating, setSelectedRating] = useState<'F15' | 'F30' | 'F60' | 'F90' | 'F120'>('F60');

    // Factores normativos de película seca (DFT) según retardo al fuego
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

    // Perfiles estructurales de referencia para verificación en obra
    const sampleProfiles = [
        { id: 'HEA-200', name: 'HEA 200', exposure: 'Viga 3 Caras', m: 190, category: 'Perfil Abierto' },
        { id: 'IPE-300', name: 'IPE 300', exposure: 'Viga 3 Caras', m: 165, category: 'Perfil Abierto' },
        { id: 'TUB-150', name: 'Tubo Cuadrado 150x150x5', exposure: 'Pilar 4 Caras', m: 200, category: 'Cerrado Rect.' },
        { id: 'CIR-219', name: 'Tubo Circular Ø 219x6.3', exposure: 'Pilar 4 Caras', m: 160, category: 'Cerrado Circ.' },
    ];

    return (
        <div className="min-h-screen bg-slate-900 text-slate-100 font-sans p-6 md:p-10 selection:bg-orange-500 selection:text-white">
            {/* Header Técnico con Director de Arte Craft Floor */}
            <header className="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center pb-6 border-b border-slate-800 gap-4" role="banner">
                <div className="flex items-center gap-3">
                    <div className="p-2.5 bg-orange-600/20 border border-orange-500/30 rounded-xl text-orange-500 flex items-center justify-center">
                        <Flame className="w-7 h-7" aria-hidden="true" />
                    </div>
                    <div>
                        <div className="flex items-center gap-2">
                            <h1 className="text-xl font-bold tracking-tight text-white">
                                Especificador de Pintura & Recubrimientos
                            </h1>
                            <span className="text-[10px] font-bold uppercase tracking-wider bg-orange-500/20 text-orange-400 border border-orange-500/40 px-2 py-0.5 rounded-md">
                                v2.0 Enterprise
                            </span>
                        </div>
                        <p className="text-xs text-slate-400 mt-0.5">
                            Motor de Cálculo Estructural y Protección Pasiva contra Fuego (NCh3040 / OGUC Chile)
                        </p>
                    </div>
                </div>

                <div className="flex items-center gap-3" role="status" aria-label="Estado del puesto de trabajo">
                    <a
                        href="/especificador/dashboard"
                        className="flex items-center gap-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700 rounded-lg px-3 py-1.5 text-xs font-semibold transition-colors"
                    >
                        <span>&larr; Panel Clásico</span>
                    </a>
                    <div className="flex items-center gap-2 bg-slate-800 border border-slate-700/80 rounded-lg px-3 py-1.5 text-xs text-slate-300">
                        <Laptop className="w-4 h-4 text-emerald-400" aria-hidden="true" />
                        <span>Puesto Activo: <strong className="text-white">{stats?.active_device || 'Estación Windows'}</strong></span>
                        <span className="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse" title="Sesión activa y sincronizada"></span>
                    </div>
                </div>
            </header>

            {/* Bento Grid Principal: Modo Operate */}
            <main className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-6" role="main">
                {/* Tarjeta 1: Licencia & Seguridad */}
                <section className="bg-slate-800/60 border border-slate-800 rounded-xl p-5 flex flex-col justify-between" aria-labelledby="card-license-title">
                    <div className="flex items-center justify-between text-xs text-slate-400 mb-3">
                        <h3 id="card-license-title" className="font-semibold uppercase tracking-wider text-[11px]">Licencia Unificada</h3>
                        <ShieldCheck className="w-4 h-4 text-orange-400" aria-hidden="true" />
                    </div>
                    <div>
                        <div className="text-2xl font-black text-white tracking-tight">Ilimitada</div>
                        <div className="text-xs text-emerald-400 font-medium flex items-center gap-1 mt-1">
                            <CheckCircle2 className="w-3.5 h-3.5" aria-hidden="true" />
                            Sin límite de perfiles
                        </div>
                    </div>
                    <div className="mt-4 pt-3 border-t border-slate-800 text-[11px] text-slate-400">
                        Usuario: <strong className="text-slate-200">{user?.username || 'Calculista Autorizado'}</strong>
                    </div>
                </section>

                {/* Tarjeta 2: Base Técnica de Pinturas */}
                <section className="bg-slate-800/60 border border-slate-800 rounded-xl p-5 flex flex-col justify-between" aria-labelledby="card-paints-title">
                    <div className="flex items-center justify-between text-xs text-slate-400 mb-3">
                        <h3 id="card-paints-title" className="font-semibold uppercase tracking-wider text-[11px]">Base Técnica</h3>
                        <FileSpreadsheet className="w-4 h-4 text-blue-400" aria-hidden="true" />
                    </div>
                    <div>
                        <div className="text-2xl font-black text-white tracking-tight font-mono">{stats?.paints_count || 320}</div>
                        <div className="text-xs text-slate-400 mt-1">Registros de pinturas y factores</div>
                    </div>
                    <div className="mt-4 pt-3 border-t border-slate-800 text-[11px] text-slate-400">
                        Certificación: <strong className="text-slate-200">DICTUC / IDIEM</strong>
                    </div>
                </section>

                {/* Tarjeta 3: Proyectos y Cubicaciones */}
                <section className="bg-slate-800/60 border border-slate-800 rounded-xl p-5 flex flex-col justify-between" aria-labelledby="card-projects-title">
                    <div className="flex items-center justify-between text-xs text-slate-400 mb-3">
                        <h3 id="card-projects-title" className="font-semibold uppercase tracking-wider text-[11px]">Proyectos Activos</h3>
                        <Layers className="w-4 h-4 text-purple-400" aria-hidden="true" />
                    </div>
                    <div>
                        <div className="text-2xl font-black text-white tracking-tight font-mono">{stats?.projects_count || 12}</div>
                        <div className="text-xs text-slate-400 mt-1 font-mono">{stats?.profiles_count || 148} perfiles calculados</div>
                    </div>
                    <div className="mt-4 pt-3 border-t border-slate-800 text-[11px] text-slate-400">
                        Exportación: <strong className="text-slate-200">PDF Oficial NCh3040</strong>
                    </div>
                </section>

                {/* Tarjeta 4: Estado del Puesto Anti-Sharing */}
                <section className="bg-slate-800/60 border border-slate-800 rounded-xl p-5 flex flex-col justify-between" aria-labelledby="card-session-title">
                    <div className="flex items-center justify-between text-xs text-slate-400 mb-3">
                        <h3 id="card-session-title" className="font-semibold uppercase tracking-wider text-[11px]">Control Anti-Sharing</h3>
                        <Activity className="w-4 h-4 text-emerald-400" aria-hidden="true" />
                    </div>
                    <div>
                        <div className="text-sm font-bold text-emerald-400">Sesión Única Activa</div>
                        <div className="text-xs text-slate-400 mt-1">Kicking automático ante concurrencia</div>
                    </div>
                    <div className="mt-4 pt-3 border-t border-slate-800 text-[11px] text-slate-400">
                        Protección: <strong className="text-slate-200">Seat Kicking en tiempo real</strong>
                    </div>
                </section>

                {/* Widget de Cálculo Reactivo de Masividad & Resistencia */}
                <section className="md:col-span-3 lg:col-span-4 bg-slate-800/80 border border-slate-800 rounded-xl p-6 mt-2" aria-labelledby="calc-section-title">
                    <div className="flex items-center justify-between mb-5 flex-wrap gap-3">
                        <div className="flex items-center gap-2">
                            <Calculator className="w-5 h-5 text-orange-500" aria-hidden="true" />
                            <h2 id="calc-section-title" className="text-base font-bold text-white">Calculadora Reactiva de Masividad y Espesor</h2>
                        </div>
                        
                        {/* Selector de Clasificación Térmica F15 - F120 */}
                        <div className="flex items-center gap-1.5 bg-slate-900/80 p-1 rounded-lg border border-slate-800" role="group" aria-label="Selección de retardo al fuego">
                            {(['F15', 'F30', 'F60', 'F90', 'F120'] as const).map((rating) => (
                                <button
                                    key={rating}
                                    type="button"
                                    onClick={() => setSelectedRating(rating)}
                                    aria-pressed={selectedRating === rating}
                                    className={`px-2.5 py-1 text-xs font-mono font-bold rounded transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 ${
                                        selectedRating === rating
                                            ? 'bg-orange-600 text-white'
                                            : 'text-slate-400 hover:text-white hover:bg-slate-800'
                                    }`}
                                >
                                    {rating}
                                </button>
                            ))}
                        </div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                        {/* Control Slider de Masividad */}
                        <div>
                            <div className="flex justify-between items-baseline mb-2">
                                <label htmlFor="masividad-slider" className="text-xs font-semibold text-slate-300">
                                    Factor de Masividad $M$
                                </label>
                                <span className="text-xs font-mono text-orange-400 font-bold">
                                    {masividadInput} m²/ton
                                </span>
                            </div>
                            <input 
                                id="masividad-slider"
                                type="range" 
                                min="30" 
                                max="350" 
                                value={masividadInput}
                                onChange={(e) => setMasividadInput(Number(e.target.value))}
                                aria-label="Factor de Masividad M en m² por tonelada"
                                className="w-full accent-orange-500 cursor-pointer h-2 bg-slate-700 rounded-lg"
                            />
                            <div className="flex justify-between text-[11px] text-slate-400 mt-1.5 font-mono">
                                <span>30 m²/ton</span>
                                <span>350 m²/ton</span>
                            </div>
                        </div>

                        {/* Selector de Norma */}
                        <div>
                            <span className="text-xs font-semibold text-slate-300 block mb-2">
                                Norma de Referencia
                            </span>
                            <div className="flex gap-2" role="radiogroup" aria-label="Normativa de referencia">
                                <button 
                                    type="button"
                                    role="radio"
                                    aria-checked={selectedStandard === 'NCh3040'}
                                    onClick={() => setSelectedStandard('NCh3040')}
                                    className={`px-3 py-1.5 rounded-lg text-xs font-bold transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 ${
                                        selectedStandard === 'NCh3040' 
                                            ? 'bg-orange-600 text-white' 
                                            : 'bg-slate-900 text-slate-400 hover:text-white border border-slate-700'
                                    }`}
                                >
                                    NCh3040.Of2007
                                </button>
                                <button 
                                    type="button"
                                    role="radio"
                                    aria-checked={selectedStandard === 'OGUC'}
                                    onClick={() => setSelectedStandard('OGUC')}
                                    className={`px-3 py-1.5 rounded-lg text-xs font-bold transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 ${
                                        selectedStandard === 'OGUC' 
                                            ? 'bg-orange-600 text-white' 
                                            : 'bg-slate-900 text-slate-400 hover:text-white border border-slate-700'
                                    }`}
                                >
                                    OGUC Art. 4.3.3
                                </button>
                            </div>
                        </div>

                        {/* Display de Resultado Técnico */}
                        <div className="bg-slate-950 border border-slate-800 rounded-xl p-4 flex items-center justify-between" role="region" aria-label="Resultado de espesor calculado">
                            <div>
                                <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">
                                    Espesor Recomendado ({selectedRating})
                                </span>
                                {isExceedingRange ? (
                                    <div className="flex items-center gap-1.5 mt-1 text-red-400">
                                        <AlertTriangle className="w-4 h-4" aria-hidden="true" />
                                        <span className="text-sm font-bold">Fuera de Rango Certificado</span>
                                    </div>
                                ) : (
                                    <span className="text-2xl font-black text-orange-400 font-mono">
                                        {estimatedThickness} <span className="text-xs text-slate-400 font-normal">μm DFT</span>
                                    </span>
                                )}
                            </div>
                            <span className="text-[10px] bg-slate-800 px-2 py-1 rounded text-slate-300 font-mono">
                                ± 5% tol.
                            </span>
                        </div>
                    </div>
                </section>

                {/* Tabla Técnica de Perfiles Normalizados */}
                <section className="md:col-span-3 lg:col-span-4 bg-slate-800/50 border border-slate-800 rounded-xl p-6 mt-2" aria-labelledby="profiles-table-title">
                    <h2 id="profiles-table-title" className="text-sm font-bold text-white mb-4 uppercase tracking-wider text-[11px] text-slate-300">
                        Matriz de Verificación de Perfiles Estructurales Tipo
                    </h2>
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-xs border-collapse" role="table">
                            <thead>
                                <tr className="border-b border-slate-800 text-slate-400 font-semibold font-mono">
                                    <th className="pb-2.5">Perfil Tipo</th>
                                    <th className="pb-2.5">Clasificación</th>
                                    <th className="pb-2.5">Exposición</th>
                                    <th className="pb-2.5">Masividad ($M$)</th>
                                    <th className="pb-2.5">DFT ({selectedRating})</th>
                                    <th className="pb-2.5 text-right">Estado Normativo</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-slate-800/60 font-mono">
                                {sampleProfiles.map((p) => {
                                    const dft = Math.round(p.m * currentConfig.factor + currentConfig.base);
                                    const complies = p.m <= currentConfig.maxM;
                                    return (
                                        <tr key={p.id} className="hover:bg-slate-800/40 transition-colors">
                                            <td className="py-3 font-bold text-white">{p.name}</td>
                                            <td className="py-3 text-slate-400">{p.category}</td>
                                            <td className="py-3 text-slate-300">{p.exposure}</td>
                                            <td className="py-3 text-orange-400 font-bold">{p.m} m²/ton</td>
                                            <td className="py-3 text-slate-200">{dft} μm</td>
                                            <td className="py-3 text-right">
                                                <span className={`inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold ${
                                                    complies 
                                                        ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' 
                                                        : 'bg-red-500/10 text-red-400 border border-red-500/20'
                                                }`}>
                                                    {complies ? 'Conforme' : 'Excede Límite'}
                                                </span>
                                            </td>
                                        </tr>
                                    );
                                })}
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    );
}
