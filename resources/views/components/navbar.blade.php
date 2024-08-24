<nav 
    {{ $attributes->class([
            'border-b-[1px] flex py-3 items-center space-x-8 max-w-full w-full px-2 bg-white text-neutral-900 dark:bg-black dark:text-neutral-100 dark:border-b-[1px] dark:border-neutral-900/60'
        ]) 
    }}"
>
    {{ $slot }}
</nav>