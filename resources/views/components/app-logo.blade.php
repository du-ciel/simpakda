@props([
    'sidebar' => false,
    'logoPath' => null,
    'logoSize' => 'size-8', // Diperkecil agar pas untuk Sidebar/Navbar
    'textSize' => 'text-xl', // Diperbesar sedikit agar seimbang dengan logo
    'logoClass' => '',
    'textClass' => '',
])

@php
    $brandName = config('app.name') === 'Laravel'
        ? 'Simpakda'
        : config('app.name', 'Simpakda');

    $logoPath = $logoPath ?: asset('logo.svg');
@endphp

@if($sidebar)
    <a
        {{ $attributes->merge(['href' => route('dashboard')])->class([
            'group flex items-center gap-3 px-3 py-4 transition-all',
            'in-data-flux-sidebar-collapsed-desktop:justify-center',
            'in-data-flux-sidebar-collapsed-desktop:px-0',
        ]) }}
        data-flux-sidebar-brand
    >
        {{-- LOGO --}}
        <span class="{{ $logoSize }} {{ $logoClass }} shrink-0 flex items-center justify-center">
            <img
                src="{{ $logoPath }}"
                alt="{{ $brandName }}"
                class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-110"
            />
        </span>

        {{-- NAMA --}}
        <span class="{{ $textSize }} {{ $textClass }} truncate font-bold tracking-tight text-white in-data-flux-sidebar-collapsed-desktop:hidden">
            {{ $brandName }}
        </span>
    </a>

@else

    <a
        {{ $attributes->merge(['href' => route('dashboard')])->class([
            'group flex items-center gap-3 transition-all',
        ]) }}
    >
        {{-- LOGO --}}
        <span class="{{ $logoSize }} {{ $logoClass }} shrink-0 flex items-center justify-center">
            <img
                src="{{ $logoPath }}"
                alt="{{ $brandName }}"
                class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-110"
            />
        </span>

        {{-- NAMA --}}
        <span class="{{ $textSize }} {{ $textClass }} font-bold tracking-tight text-slate-900 dark:text-white">
            {{ $brandName }}
        </span>
    </a>

@endif