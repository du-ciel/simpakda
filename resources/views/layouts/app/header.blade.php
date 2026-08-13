<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#f3fbff] text-slate-800 dark:bg-slate-950 dark:text-slate-100">
        <flux:header container class="dark relative border-b border-white/15 bg-gradient-to-br from-cyan-700 via-sky-800 to-indigo-900 shadow-[0_4px_16px_-8px_rgba(15,23,42,0.7)]">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <!-- Logo diposisikan absolute supaya selalu center, tidak terpengaruh lebar elemen kiri/kanan -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
            </div>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <x-desktop-user-menu />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="dark lg:hidden border-e border-white/15 bg-gradient-to-br from-cyan-700 via-sky-800 to-indigo-900 shadow-[8px_0_24px_-10px_rgba(15,23,42,0.7)]">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Menu Utama')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>
        </flux:sidebar>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>