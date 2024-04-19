@props([
    'href' => '#',
])

<a href="{{ $href }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out text-gray-900 dark:text-gray-100">
    {{ $slot }}
</a>
