@props(['status'])

@php
    $config = [
        'todo' => [
            'label' => 'À faire',
            'classes' => 'bg-slate-100 text-slate-800',
            'dot' => 'bg-slate-400'
        ],
        'in_progress' => [
            'label' => 'En cours',
            'classes' => 'bg-blue-100 text-blue-800',
            'dot' => 'bg-blue-600'
        ],
        'completed' => [
            'label' => 'Terminé',
            'classes' => 'bg-green-100 text-green-800',
            'dot' => 'bg-green-600'
        ]
    ];

    $current = $config[$status] ?? $config['todo'];
@endphp

<span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-medium {{ $current['classes'] }}">
    <span class="size-1.5 inline-block rounded-full {{ $current['dot'] }}"></span>
    {{ $current['label'] }}
</span>