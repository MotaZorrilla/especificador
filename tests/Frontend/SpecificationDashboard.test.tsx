import React from 'react';
import { render, screen, fireEvent, within } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import SpecificationDashboard from '@/Pages/SpecificationDashboard';

describe('SpecificationDashboard Reinterpreted Component (React 19 v2.0)', () => {
    const mockUser = {
        username: 'admin',
        email: 'admin@pinturaintumescente.cl',
        name: 'Administrador General',
    };

    const mockTotals = {
        user: 'admin',
        users: 14,
        data: 520,
        plans: 2,
        projects: 28,
        profiles: 340,
        roles: 4,
        user_projects: 9,
        user_profiles: 85,
    };

    const mockPermissions = {
        user: true,
        projectAdmin: true,
        project: true,
        filedata: true,
        role: true,
        plan: true,
    };

    it('renders main navbar with branding and side-by-side switcher (Clásico vs React v2.0)', () => {
        render(
            <SpecificationDashboard 
                user={mockUser} 
                totals={mockTotals} 
                permissions={mockPermissions} 
                active_device="Dell Workstation / Windows 11" 
            />
        );

        expect(screen.getByText('Bienvenido al Panel del Especificador de Pintura Intumescente')).toBeInTheDocument();
        expect(screen.getByText(/Reinterpretación React 19 v2.0/i)).toBeInTheDocument();
        
        // Switcher links
        const classicLink = screen.getByRole('link', { name: /Clásico/i });
        expect(classicLink).toBeInTheDocument();
        expect(classicLink).toHaveAttribute('href', '/especificador/dashboard');
        
        expect(screen.getByText(/React v2.0/i)).toBeInTheDocument();
        expect(screen.getByText('Dell Workstation / Windows 11')).toBeInTheDocument();
    });

    it('renders all 7 signature classic cards with corresponding totals and links', () => {
        render(
            <SpecificationDashboard 
                user={mockUser} 
                totals={mockTotals} 
                permissions={mockPermissions} 
            />
        );

        // 1. Mi Perfil
        expect(screen.getByText('Mi Perfil')).toBeInTheDocument();
        expect(screen.getByText('Hola admin')).toBeInTheDocument();

        // 2. Usuarios
        expect(screen.getByText('Usuarios')).toBeInTheDocument();
        expect(screen.getByText('Total Usuarios: 14')).toBeInTheDocument();

        // 3. Administrador de Proyectos
        expect(screen.getByText('Administrador de Proyectos')).toBeInTheDocument();
        expect(screen.getByText('Proyectos Totales: 28')).toBeInTheDocument();
        expect(screen.getByText('Perfiles Totales: 340')).toBeInTheDocument();

        // 4. Mis Proyectos
        expect(screen.getByText('Mis Proyectos')).toBeInTheDocument();
        expect(screen.getByText('Proyectos Totales: 9')).toBeInTheDocument();
        expect(screen.getByText('Perfiles Totales: 85')).toBeInTheDocument();

        // 5. Data
        expect(screen.getByText('Data')).toBeInTheDocument();
        expect(screen.getByText('Registros Totales de Pinturas: 520')).toBeInTheDocument();

        // 6. Roles
        expect(screen.getByText('Roles')).toBeInTheDocument();
        expect(screen.getByText('Roles Totales: 4')).toBeInTheDocument();

        // 7. Planes
        expect(screen.getByText('Planes')).toBeInTheDocument();
        expect(screen.getByText('Planes Totales: 2')).toBeInTheDocument();
    });

    it('filters cards reactively when typing in the search input', () => {
        render(
            <SpecificationDashboard 
                user={mockUser} 
                totals={mockTotals} 
                permissions={mockPermissions} 
            />
        );

        const searchInput = screen.getByPlaceholderText('Filtrar módulos o tarjetas...');
        fireEvent.change(searchInput, { target: { value: 'Roles' } });

        expect(screen.getByText('Roles')).toBeInTheDocument();
        expect(screen.queryByText('Usuarios')).not.toBeInTheDocument();
        expect(screen.queryByText('Data')).not.toBeInTheDocument();
        expect(screen.queryByText('Planes')).not.toBeInTheDocument();

        // Clear filter
        fireEvent.change(searchInput, { target: { value: '' } });
        expect(screen.getByText('Usuarios')).toBeInTheDocument();
        expect(screen.getByText('Data')).toBeInTheDocument();
    });

    it('hides cards when permissions are disabled', () => {
        const restrictedPermissions = {
            ...mockPermissions,
            user: false,
            role: false,
            plan: false,
        };

        render(
            <SpecificationDashboard 
                user={mockUser} 
                totals={mockTotals} 
                permissions={restrictedPermissions} 
            />
        );

        expect(screen.getByText('Mi Perfil')).toBeInTheDocument();
        expect(screen.getByText('Mis Proyectos')).toBeInTheDocument();
        expect(screen.queryByText('Usuarios')).not.toBeInTheDocument();
        expect(screen.queryByText('Roles')).not.toBeInTheDocument();
        expect(screen.queryByText('Planes')).not.toBeInTheDocument();
    });

    it('opens and interacts with the quick massivity & DFT calculator modal', () => {
        render(
            <SpecificationDashboard 
                user={mockUser} 
                totals={mockTotals} 
                permissions={mockPermissions} 
            />
        );

        // Open modal
        const calcButton = screen.getByTitle('Abrir Calculadora Rápida de Masividad P/A');
        fireEvent.click(calcButton);

        expect(screen.getByText('Simulador Rápido de Masividad & Espesor')).toBeInTheDocument();
        expect(screen.getByText(/NCh3040.Of2007 y ordenanza OGUC Chile/i)).toBeInTheDocument();

        // Test slider change
        const slider = screen.getByLabelText(/Factor de Masividad M/i);
        fireEvent.change(slider, { target: { value: '200' } });

        // Select F30 rating: 200 * 2.10 + 120 = 540 μm
        const f30Btn = screen.getByRole('button', { name: 'F30' });
        fireEvent.click(f30Btn);
        expect(screen.getByText(/540/)).toBeInTheDocument();

        // Close modal
        const closeBtn = screen.getByLabelText('Cerrar modal');
        fireEvent.click(closeBtn);
        expect(screen.queryByText('Simulador Rápido de Masividad & Espesor')).not.toBeInTheDocument();
    });

    it('gracefully renders fallback values when props are omitted', () => {
        render(<SpecificationDashboard />);

        expect(screen.getByText('Mi Perfil')).toBeInTheDocument();
        expect(screen.getByText('Hola admin')).toBeInTheDocument();
        expect(screen.getByText('Total Usuarios: 1')).toBeInTheDocument();
        expect(screen.getByText('Estación Windows')).toBeInTheDocument();
    });
});
