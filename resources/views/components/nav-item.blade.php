@props(['href' => '#', 'color' => 'gray-500'])

<a href="{{ $href }}" :class="'text-' + {{ $color }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
    {{ $slot }}
</a>
