@php
    $color = match($status) {
        'hadir' => 'green',
        'izin' => 'yellow',
        'sakit' => 'blue',
        'alpha' => 'red',
        default => 'gray'
    };
    $label = match($status) {
        'hadir' => 'Hadir',
        'izin' => 'Izin',
        'sakit' => 'Sakit',
        'alpha' => 'Alpha',
        default => ucfirst($status)
    };
@endphp
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
    {{ $label }}
</span>