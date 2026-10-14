@props(['active' => false])

<a {{ $attributes }} style="color: {{ $active ? 'red' : 'blue' }}">{{ $slot }}</a>
