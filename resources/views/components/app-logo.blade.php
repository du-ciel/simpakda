@props([
    'sidebar' => false,
    'logoPath' => null,
    'logoSize' => 'size-14',
    'textSize' => 'text-lg',
    'logoClass' => '',
    'textClass' => '',
])

@php
    $brandName = config('app.name') === 'Laravel' ? 'Simpakda' : config('app.name', 'Simpakda');
    $logoPath = $logoPath ?: asset('logo.svg');
@endphp

{{--
    Ukuran dan gaya bisa diubah saat pemanggilan komponen:
    <x-app-logo :logo-size="'size-14'" :text-size="'text-base' 'items-center'" />
    Ganti public/logo.svg jika ingin memakai logo organisasi sendiri.
--}}
@if($sidebar)
    <a
        {{ $attributes->merge(['href' => route('dashboard')])->class([
            'group flex h-auto min-w-0 flex-col items-center justify-center gap-2 px-2 py-3 text-center',
            'in-data-flux-sidebar-collapsed-desktop:h-10 in-data-flux-sidebar-collapsed-desktop:w-10 in-data-flux-sidebar-collapsed-desktop:px-0',
            'in-data-flux-sidebar-collapsed-desktop:in-data-flux-sidebar-active:absolute in-data-flux-sidebar-collapsed-desktop:in-data-flux-sidebar-active:opacity-0',
        ]) }}
        data-flux-sidebar-brand
    >
        <span class="{{ $logoSize }} {{ $logoClass }} flex shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white/15 p-1.5 ring-1 ring-white/20 transition group-hover:bg-white/25">
            <img src="{{ $logoPath }}" alt="{{ $brandName }}" class="size-full object-contain" />
        </span>
        <span class="{{ $textSize }} {{ $textClass }} min-w-0 max-w-full truncate font-semibold tracking-wide text-white in-data-flux-sidebar-collapsed-desktop:hidden">
            {{ $brandName }}
        </span>
    </a>
@else
    <a
        {{ $attributes->merge(['href' => route('dashboard')])->class(['group flex flex-col items-center justify-center gap-1.5 text-center']) }}
    >
        <span class="{{ $logoSize }} {{ $logoClass }} flex shrink-0 items-center justify-center overflow-hidden rounded-xl bg-cyan-600 p-1.5 shadow-sm transition group-hover:bg-cyan-700">
            <img src="{{ $logoPath }}" alt="{{ $brandName }}" class="size-full object-contain" />
        </span>
        <span class="{{ $textSize }} {{ $textClass }} font-semibold tracking-wide text-slate-800 dark:text-white">
            {{ $brandName }}
        </span>
    </a>
@endif
