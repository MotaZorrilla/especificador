import React from 'react';
import { render, screen, fireEvent, within } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import SpecificationDashboard from '@/Pages/SpecificationDashboard';

describe('SpecificationDashboard Component', () => {
    const mockUser = {
        username: 'Ing. Carlos Mendoza',
        email: 'carlos.mendoza@calculo-estructural.cl',
    };

    const mockStats = {
        paints_count: 384,
        projects_count: 15,
        profiles_count: 260,
        active_device: 'Dell Precision / Windows 11',
    };

    it('renders main header, v2.0 Enterprise badge and active workstation', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        expect(screen.getByText('Especificador de Pintura & Recubrimientos')).toBeInTheDocument();
        expect(screen.getByText('v2.0 Enterprise')).toBeInTheDocument();
        expect(screen.getByText('Dell Precision / Windows 11')).toBeInTheDocument();
        expect(screen.getByText(/NCh3040 \/ OGUC Chile/i)).toBeInTheDocument();
    });

    it('renders all bento grid summary cards with metrics', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        // Tarjeta Licencia
        expect(screen.getByText('Licencia Unificada')).toBeInTheDocument();
        expect(screen.getByText('Ilimitada')).toBeInTheDocument();
        expect(screen.getByText(/Sin límite de perfiles/i)).toBeInTheDocument();
        expect(screen.getByText('Ing. Carlos Mendoza')).toBeInTheDocument();

        // Tarjeta Base Técnica
        expect(screen.getByText('Base Técnica')).toBeInTheDocument();
        expect(screen.getByText('384')).toBeInTheDocument();

        // Tarjeta Proyectos Activos
        expect(screen.getByText('Proyectos Activos')).toBeInTheDocument();
        expect(screen.getByText('15')).toBeInTheDocument();
        expect(screen.getByText(/260 perfiles calculados/i)).toBeInTheDocument();

        // Tarjeta Control Anti-Sharing
        expect(screen.getByText('Control Anti-Sharing')).toBeInTheDocument();
        expect(screen.getByText('Sesión Única Activa')).toBeInTheDocument();
    });

    it('recalculates dry film thickness reactively when masividad slider moves', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        const resultRegion = screen.getByRole('region', { name: /Resultado de espesor calculado/i });

        // Valor inicial: M = 125, F60 -> 125 * 3.45 + 180 = 611 μm
        expect(within(resultRegion).getByText(/611/)).toBeInTheDocument();

        const slider = screen.getByLabelText(/Factor de Masividad M/i);
        fireEvent.change(slider, { target: { value: '200' } });

        // Nuevo valor: M = 200, F60 -> 200 * 3.45 + 180 = 870 μm
        expect(screen.getAllByText('200 m²/ton').length).toBeGreaterThanOrEqual(1);
        expect(within(resultRegion).getByText(/870/)).toBeInTheDocument();
    });

    it('allows toggling between NCh3040 and OGUC standards', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        const nchButton = screen.getByRole('radio', { name: /NCh3040/i });
        const ogucButton = screen.getByRole('radio', { name: /OGUC/i });

        expect(nchButton).toHaveAttribute('aria-checked', 'true');
        expect(ogucButton).toHaveAttribute('aria-checked', 'false');

        fireEvent.click(ogucButton);

        expect(nchButton).toHaveAttribute('aria-checked', 'false');
        expect(ogucButton).toHaveAttribute('aria-checked', 'true');
    });

    it('allows selecting different fire ratings and adjusts thickness calculation', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        const resultRegion = screen.getByRole('region', { name: /Resultado de espesor calculado/i });

        // Seleccionar F15: 125 * 1.15 + 75 = 219 μm
        const f15Button = screen.getByRole('button', { name: 'F15' });
        fireEvent.click(f15Button);
        expect(f15Button).toHaveAttribute('aria-pressed', 'true');
        expect(within(resultRegion).getByText(/219/)).toBeInTheDocument();

        // Seleccionar F120: 125 * 6.20 + 350 = 1125 μm
        const f120Button = screen.getByRole('button', { name: 'F120' });
        fireEvent.click(f120Button);
        expect(f120Button).toHaveAttribute('aria-pressed', 'true');
        expect(within(resultRegion).getByText(/1125/)).toBeInTheDocument();
    });

    it('displays out of range warning when masividad exceeds maximum certified limits', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        // Seleccionar F120 (límite máx M = 190)
        const f120Button = screen.getByRole('button', { name: 'F120' });
        fireEvent.click(f120Button);

        // Deslizar masividad a 300
        const slider = screen.getByLabelText(/Factor de Masividad M/i);
        fireEvent.change(slider, { target: { value: '300' } });

        expect(screen.getByText('Fuera de Rango Certificado')).toBeInTheDocument();
    });

    it('handles boundary slider values (minimum 30 and maximum 350)', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        const slider = screen.getByLabelText(/Factor de Masividad M/i);
        const resultRegion = screen.getByRole('region', { name: /Resultado de espesor calculado/i });

        // Min boundary 30: F60 -> 30 * 3.45 + 180 = 284 μm
        fireEvent.change(slider, { target: { value: '30' } });
        expect(screen.getAllByText('30 m²/ton').length).toBeGreaterThanOrEqual(1);
        expect(within(resultRegion).getByText(/284/)).toBeInTheDocument();

        // Max boundary 350: F60 maxM is 280, so 350 exceeds certified range
        fireEvent.change(slider, { target: { value: '350' } });
        expect(screen.getAllByText('350 m²/ton').length).toBeGreaterThanOrEqual(1);
        expect(screen.getByText('Fuera de Rango Certificado')).toBeInTheDocument();
    });

    it('verifies intermediate fire ratings F30 and F90 calculations', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        const resultRegion = screen.getByRole('region', { name: /Resultado de espesor calculado/i });

        // F30: 125 * 2.10 + 120 = 383 μm
        const f30Button = screen.getByRole('button', { name: 'F30' });
        fireEvent.click(f30Button);
        expect(within(resultRegion).getByText(/383/)).toBeInTheDocument();

        // F90: 125 * 4.80 + 260 = 860 μm
        const f90Button = screen.getByRole('button', { name: 'F90' });
        fireEvent.click(f90Button);
        expect(within(resultRegion).getByText(/860/)).toBeInTheDocument();
    });

    it('gracefully renders fallback values when user and stats props are missing', () => {
        render(<SpecificationDashboard />);

        expect(screen.getByText('Calculista Autorizado')).toBeInTheDocument();
        expect(screen.getByText('Estación Windows')).toBeInTheDocument();
        expect(screen.getByText('320')).toBeInTheDocument(); // default paints
        expect(screen.getByText('12')).toBeInTheDocument();  // default projects
        expect(screen.getByText(/148 perfiles calculados/i)).toBeInTheDocument();
    });

    it('renders the structural profiles verification matrix table with correct values', () => {
        render(<SpecificationDashboard user={mockUser} stats={mockStats} />);

        expect(screen.getByText('Matriz de Verificación de Perfiles Estructurales Tipo')).toBeInTheDocument();
        expect(screen.getByText('HEA 200')).toBeInTheDocument();
        expect(screen.getByText('IPE 300')).toBeInTheDocument();
        expect(screen.getByText('Tubo Cuadrado 150x150x5')).toBeInTheDocument();
        expect(screen.getByText('Tubo Circular Ø 219x6.3')).toBeInTheDocument();

        // Verificar que existan badges de conformidad
        const badges = screen.getAllByText('Conforme');
        expect(badges.length).toBe(4);
    });
});
