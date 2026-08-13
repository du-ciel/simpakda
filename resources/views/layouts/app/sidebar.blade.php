<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-b from-sky-50 to-cyan-50 text-slate-800 dark:from-sky-950/30 dark:to-cyan-950/30 dark:text-slate-100">
        <flux:sidebar sticky collapsible="mobile" class="dark border-e border-white/15 bg-gradient-to-br from-cyan-700 via-sky-800 to-indigo-900 shadow-[8px_0_24px_-10px_rgba(15,23,42,0.7)]">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate class="text-white" />
                <flux:sidebar.collapse class="text-white hover:bg-white/10 lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Menu Utama')" class="grid text-white">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="text-white hover:bg-white/10 hover:text-white data-current:bg-white/15 data-current:text-white">
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="chart-bar" :href="route('monitoring')" :current="request()->routeIs('monitoring')" wire:navigate class="text-white hover:bg-white/10 hover:text-white data-current:bg-white/15 data-current:text-white">
                        {{ __('Monitoring') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="truck" :href="route('vehicles.index')" :current="request()->routeIs('vehicles.*')" wire:navigate class="text-white hover:bg-white/10 hover:text-white data-current:bg-white/15 data-current:text-white">
                        {{ __('Kendaraan') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <div class="mx-3 mb-3 rounded-2xl border border-white/15 bg-white/10 p-3 text-xs text-white">
                <div class="flex items-center gap-2 font-medium text-white"><flux:icon name="shield-check" class="size-4 text-white" /> Sistem Armada</div>
                <div class="mt-1 text-white/75">Kelola kendaraan dengan mudah.</div>
            </div>

            <x-desktop-user-menu class="hidden lg:block text-white" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="border-b border-white/15 bg-gradient-to-br from-cyan-700 via-sky-800 to-indigo-900 text-white shadow-[0_4px_16px_-8px_rgba(15,23,42,0.7)] lg:hidden">
            <flux:sidebar.toggle class="text-white lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile class="text-white"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
