<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-800 dark:bg-[#020617] dark:text-slate-100">
        
        {{-- ==========================================
            HEADER / TOP NAV (Tema Deep Navy)
        =========================================== --}}
        <flux:header container class="dark relative border-b border-white/5 bg-gradient-to-r from-[#111827] to-[#0b334d] shadow-md z-50">
            <flux:sidebar.toggle class="lg:hidden mr-2 text-white" icon="bars-2" inset="left" />

            {{-- Logo di Kiri/Tengah (Ukuran disesuaikan agar tidak kebesaran) --}}
            <div class="flex items-center gap-4">
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate class="text-white" />
            </div>

            <flux:spacer class="max-lg:hidden" />

            {{-- Navigasi Desktop --}}
            <flux:navbar class="-mb-px max-lg:hidden flex gap-1">
                <flux:navbar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="text-slate-300 hover:text-white data-current:text-cyan-400">
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item icon="chart-bar" :href="route('monitoring')" :current="request()->routeIs('monitoring')" wire:navigate class="text-slate-300 hover:text-white data-current:text-cyan-400">
                    {{ __('Monitoring') }}
                </flux:navbar.item>
                <flux:navbar.item icon="truck" :href="route('vehicles.index')" :current="request()->routeIs('vehicles.*')" wire:navigate class="text-slate-300 hover:text-white data-current:text-cyan-400">
                    {{ __('Kendaraan') }}
                </flux:navbar.item>
                <flux:navbar.item icon="calculator" :href="route('anggaran')" :current="request()->routeIs('anggaran')" wire:navigate class="text-slate-300 hover:text-white data-current:text-cyan-400">
                    {{ __('Anggaran') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            {{-- Menu Profil --}}
            <x-desktop-user-menu class="text-white" />
        </flux:header>

        {{-- ==========================================
            MOBILE SIDEBAR (Tema Deep Navy)
        =========================================== --}}
        <flux:sidebar collapsible="mobile" sticky class="dark lg:hidden border-e border-white/5 bg-gradient-to-b from-[#111827] to-[#0b334d] shadow-[8px_0_24px_-10px_rgba(0,0,0,0.6)] z-50">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate class="text-white" />
                <flux:sidebar.collapse class="text-white hover:bg-white/10 in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Menu Utama')" class="grid text-white">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="text-white hover:bg-white/10 data-current:bg-white/15">
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="chart-bar" :href="route('monitoring')" :current="request()->routeIs('monitoring')" wire:navigate class="text-white hover:bg-white/10 data-current:bg-white/15">
                        {{ __('Monitoring') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="truck" :href="route('vehicles.index')" :current="request()->routeIs('vehicles.*')" wire:navigate class="text-white hover:bg-white/10 data-current:bg-white/15">
                        {{ __('Kendaraan') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="calculator" :href="route('anggaran')" :current="request()->routeIs('anggaran')" wire:navigate class="text-white hover:bg-white/10 data-current:bg-white/15">
                        {{ __('Anggaran') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>
            
            <flux:spacer />

            {{-- Kartu Info Bawah Sidebar Mobile --}}
            <div class="mx-3 mb-3 rounded-2xl border border-white/10 bg-white/5 p-3 text-xs text-white backdrop-blur-md">
                <div class="flex items-center gap-2 font-medium text-white"><flux:icon name="shield-check" class="size-4 text-cyan-400" /> Sistem Armada</div>
                <div class="mt-1 text-slate-300">Kelola kendaraan dengan mudah.</div>
            </div>
        </flux:sidebar>

        {{-- ==========================================
            SLOT KONTEN UTAMA
        =========================================== --}}
        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>