@props(['status'])

@php
    $statusColors = [
        'todo' => 'bg-slate-900',
        'in_progress' => 'bg-blue-600',
        'completed' => 'bg-emerald-500',
    ];
    $bgColor = $statusColors[$status] ?? 'bg-slate-900';
@endphp

<span class="{{ $bgColor }} text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase shadow-lg">
    {{ str_replace('_', ' ', $status) }}
</span>