@props(['active' => false])

<a {{ $attributes->class(['text-[#D62839]' => $active]) }}>{{ $slot }}</a>
