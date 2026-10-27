@props(['active' => false])

<a {{ $attributes }} style="color: {{ $active ? 'red' : '[#1C1C1C]' }}">{{ $slot }}</a>
