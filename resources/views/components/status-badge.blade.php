@props([
    'status' => 'pending'
])

@php
    $classes = 'badge';

    if($status === 'pending')
        $classes .= ' badge-warning';
    if($status === 'in_progress')
        $classes .= ' badge-primary';
    if($status === 'complated')
        $classes .= '  badge-success';


@endphp
<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $status }}
</div>