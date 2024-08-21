<?php

namespace Electrik\Slate\Helpers;

class SlateUiHelper {

    // Existing methods for input component...

    public static function getButtonClasses($size, $color, $outlined, $rounded, $disabled, $loading) {
        $baseClasses = 'inline-flex items-center justify-center font-medium focus:outline-none transition ease-in-out duration-150';
        $loadingClasses = $loading ? 'relative' : '';
        $sizes = [
            'sm' => 'px-2.5 py-1.5 text-sm',
            'md' => 'px-3 py-2 text-base',
            'lg' => 'px-4 py-3 text-lg',
            'xl' => 'px-5 py-4 text-xl',
        ];
        $sizeClass = $sizes[$size] ?? $sizes['md'];
        $roundedClasses = $rounded ? 'rounded-full' : 'rounded-md';
        $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';

        $colorClasses = self::getColorClasses($color, $outlined);

        return implode(' ', [
            $baseClasses,
            $loadingClasses,
            $sizeClass,
            $colorClasses,
            $roundedClasses,
            $disabledClasses
        ]);
    }

    private static function getColorClasses($color, $outlined)
    {
        if ($outlined) {
            return in_array($color, ['black', 'white']) ?
                ($color === 'black' ? "border-black text-black hover:bg-neutral-800 dark:border-white dark:text-white dark:hover:bg-neutral-200" : "border-white text-white hover:bg-neutral-100 dark:border-black dark:text-black dark:hover:bg-neutral-800") :
                "border border-{$color}-600 text-{$color}-600 hover:bg-{$color}-500 hover:text-white dark:border-{$color}-700 dark:text-{$color}-700 dark:hover:bg-{$color}-800 dark:hover:text-white";
        } else {
            return in_array($color, ['black', 'white']) ?
                ($color === 'black' ? "bg-black text-white hover:bg-neutral-800 dark:bg-white dark:text-black dark:hover:bg-neutral-200" : "bg-white text-black hover:bg-neutral-100 dark:bg-black dark:text-white dark:hover:bg-neutral-800") :
                "bg-{$color}-500 text-white hover:bg-{$color}-600 dark:bg-{$color}-700 dark:text-white dark:hover:bg-{$color}-800";
        }
    }
}
