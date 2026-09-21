@props(['status' => 'Aman'])

@php
    $colors = match ($status) {
        'Aman'    => 'bg-green-100 text-green-700 border-green-300',
        'Menipis' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
        'Habis'   => 'bg-red-100 text-red-700 border-red-300',
        default   => 'bg-gray-100 text-gray-700 border-gray-300',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border ' . $colors]) }}>
    {{ $status }}
</span>