@props([
'color' => 'light'
])

<nav :class="{ 'bg-gray-800 text-white': color === 'dark', 'bg-white text-gray-900': color === 'light' }" class="border-b-[1px] justify-between py-3 items-center space-x-8 max-w-full w-full px-2">
    {{ $slot }}
</nav>