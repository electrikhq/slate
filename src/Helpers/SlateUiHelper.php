<?php

namespace Electrik\Slate;

class SlateUiHelper {

    // Consolidated size classes method for different components
    public static function getSizeClass($component, $size)
    {
        $sizes = [
            'button' => [
                'sm' => 'px-2.5 py-1.5 text-sm',
                'md' => 'px-3 py-2 text-base',
                'lg' => 'px-4 py-3 text-lg',
                'xl' => 'px-5 py-4 text-xl',
            ],
            'alert' => [
                'sm' => 'px-3 py-2 text-sm',
                'md' => 'px-4 py-3 text-base',
                'lg' => 'px-5 py-4 text-lg',
            ],
            'header' => [
                'sm' => 'px-3 py-2 text-sm',
                'md' => 'px-4 py-3 text-base',
                'lg' => 'px-5 py-4 text-lg',
            ],
            'avatar' => [
                'sm' => 'w-8 h-8 text-sm',
                'md' => 'w-12 h-12 text-base',
                'lg' => 'w-16 h-16 text-lg',
                'xl' => 'w-20 h-20 text-xl',
            ],
            'badge' => [
                'xs' => 'text-xs px-1.5 py-0.5',
                'sm' => 'text-sm px-2 py-1',
                'md' => 'text-base px-2.5 py-1.5',
                'lg' => 'text-lg px-3 py-2',
            ],
            'card' => [
                'sm' => 'p-2 text-sm',
                'md' => 'p-2 text-base',
                'lg' => 'p-2 text-lg',
            ],
            'checkbox' => [
                'sm' => 'h-3 w-3 text-sm',
                'md' => 'h-4 w-4 text-base',
                'lg' => 'h-5 w-5 text-lg',
                'xl' => 'h-6 w-6 text-xl',
            ],
            'input' => [
                'sm' => 'px-2 py-1 text-sm',
                'md' => 'px-3 py-2 text-base',
                'lg' => 'px-4 py-3 text-lg',
                'xl' => 'px-5 py-4 text-xl',
            ],
            'textarea' => [
                'sm' => 'px-2 py-1 text-sm',
                'md' => 'px-3 py-2 text-base',
                'lg' => 'px-4 py-3 text-lg',
                'xl' => 'px-5 py-4 text-xl',
            ],
            'select' => [
                'sm' => 'px-2 py-1 text-sm',
                'md' => 'px-3 py-2 text-base',
                'lg' => 'px-4 py-3 text-lg',
                'xl' => 'px-6 py-6 text-xl',
            ],
            'radio' => [
                'sm' => 'h-3 w-3 text-sm',
                'md' => 'h-4 w-4 text-base',  // Default size
                'lg' => 'h-5 w-5 text-lg',
                'xl' => 'h-6 w-6 text-xl',
            ],
            'dropdown' => [
                'xs' => 'text-xs py-1 px-2',
                'sm' => 'text-sm py-1 px-2',
                'md' => 'text-base py-1.5 px-3',
                'lg' => 'text-lg py-2 px-4',
            ],
            'drawer' => [
                'xs' => 'text-xs py-1 px-2',
                'sm' => 'text-sm py-1 px-2',
                'md' => 'text-base py-1.5 px-3',
                'lg' => 'text-lg py-2 px-4',
                'dimensions' => [
                    'left' => ['sm' => 'w-64', 'md' => 'w-80', 'lg' => 'w-96'],
                    'right' => ['sm' => 'w-64', 'md' => 'w-80', 'lg' => 'w-96'],
                    'top' => ['sm' => 'h-32', 'md' => 'h-48', 'lg' => 'h-64'],
                    'bottom' => ['sm' => 'h-32', 'md' => 'h-48', 'lg' => 'h-64'],
                ],
            ],
            'status' => [
                'xs' => 'h-2 w-2',
                'sm' => 'h-3 w-3',
                'md' => 'h-4 w-4',
                'lg' => 'h-5 w-5',
                'xl' => 'h-6 w-6',
            ],
            'toggle' => [
                'sm' => 'w-9 h-5 after:h-4 after:w-4 after:top-[2px] after:left-[2px]',
                'md' => 'w-11 h-6 after:h-5 after:w-5 after:top-[2px] after:left-[2px]',
                'lg' => 'w-14 h-7 after:h-6 after:w-6 after:top-0.5 after:left-[4px]',
            ],
            'table-cell' => [
                'xs' => 'text-xs py-1 px-2',
                'sm' => 'text-sm py-1 px-2',
                'md' => 'text-base py-1.5 px-3',
                'lg' => 'text-lg py-2 px-4',
            ],
        ];

        return $sizes[$component][$size] ?? $sizes[$component]['md'];
    }

    // Consolidated color classes method
    public static function getColorClasses($color, $outlined, $component = 'default')
    {
        $colorVariants = [
            'black' => [
                'default' => "bg-black text-white dark:bg-white dark:text-black",
                'outlined' => "border-black text-black dark:border-white dark:text-white",
            ],
            'white' => [
                'default' => "bg-white text-black dark:bg-black dark:text-white",
                'outlined' => "border-white text-white dark:border-black dark:text-black",
            ],
            'red' => [
                'default' => "bg-red-500 text-white dark:bg-red-700 dark:text-neutral-200",
                'outlined' => "border border-red-600 text-red-600 dark:border-red-700 dark:text-red-700",
            ],
            'green' => [
                'default' => "bg-green-500 text-white dark:bg-green-700 dark:text-neutral-200",
                'outlined' => "border border-green-600 text-green-600 dark:border-green-700 dark:text-green-700",
            ],
            'neutral' => [
                'default' => "bg-neutral-500 text-white dark:bg-neutral-700 dark:text-neutral-200",
                'outlined' => "border border-neutral-600 text-neutral-600 dark:border-neutral-700 dark:text-neutral-700",
            ],
            'indigo' => [
                'default' => "bg-indigo-500 text-white dark:bg-indigo-700 dark:text-neutral-200",
                'outlined' => "border border-indigo-600 text-indigo-600 dark:border-indigo-700 dark:text-indigo-700",
            ],
            'yellow' => [
                'default' => "bg-yellow-500 text-white dark:bg-yellow-700 dark:text-neutral-200",
                'outlined' => "border border-yellow-600 text-yellow-600 dark:border-yellow-700 dark:text-yellow-700",
            ],
            'blue' => [
                'default' => "bg-blue-500 text-white dark:bg-blue-700 dark:text-neutral-200",
                'outlined' => "border border-blue-600 text-blue-600 dark:border-blue-700 dark:text-blue-700",
            ],
            'primary' => [
                'default' => "bg-primary-500 text-white dark:bg-primary-700 dark:text-neutral-200",
                'outlined' => "border border-primary-600 text-primary-600 dark:border-primary-700 dark:text-primary-700",
            ],
            'secondary' => [
                'default' => "bg-secondary-500 text-white dark:bg-secondary-700 dark:text-neutral-200",
                'outlined' => "border border-secondary-600 text-secondary-600 dark:border-secondary-700 dark:text-secondary-700",
            ],
            'warning' => [
                'default' => "bg-warning-500 text-white dark:bg-warning-700 dark:text-neutral-200",
                'outlined' => "border border-warning-600 text-warning-600 dark:border-warning-700 dark:text-warning-700",
            ],
            'success' => [
                'default' => "bg-success-500 text-white dark:bg-success-700 dark:text-neutral-200",
                'outlined' => "border border-success-600 text-success-600 dark:border-success-700 dark:text-success-700",
            ],
            'danger' => [
                'default' => "bg-danger-500 text-white dark:bg-danger-700 dark:text-neutral-200",
                'outlined' => "border border-danger-600 text-danger-600 dark:border-danger-700 dark:text-danger-700",
            ],
            'info' => [
                'default' => "bg-info-500 text-white dark:bg-info-700 dark:text-neutral-200",
                'outlined' => "border border-info-600 text-info-600 dark:border-info-700 dark:text-gray-700",
            ],
            // Add more colors here if necessary
        ];

        // Default classes to fall back on if a specific color is not defined
        $defaultClasses = [
            'default' => "bg-gray-500 text-white dark:bg-gray-700 dark:text-neutral-200",
            'outlined' => "border border-gray-600 text-gray-600 dark:border-gray-700 dark:text-gray-700",
        ];

        // Determine the variant based on whether it's outlined or not
        $variant = $outlined ? 'outlined' : 'default';

        // Return the classes for the specified color, or fall back to the default classes
        return $colorVariants[$color][$variant] ?? $defaultClasses[$variant];
    }


    // Consolidated border color method
    public static function getBorderColor($color, $outlined)
    {
        $borderClasses = [
            'neutral' => [
                'default' => 'border-neutral-300 dark:border-neutral-600',
                'outlined' => "border-{$color}-600 dark:border-{$color}-700",
            ],
            'red' => [
                'default' => 'border-red-300 dark:border-red-600',
                'outlined' => "border-red-600 dark:border-red-700",
            ],
            'primary' => [
                'default' => 'border-primary-300 dark:border-primary-600',
                'outlined' => "border-primary-600 dark:border-primary-700",
            ],
            'secondary' => [
                'default' => 'border-secondary-300 dark:border-secondary-600',
                'outlined' => "border-green-600 dark:border-secondary-700",
            ],
            'success' => [
                'default' => 'border-success-300 dark:border-success-600',
                'outlined' => "border-success-600 dark:border-success-700",
            ],
            'warning' => [
                'default' => 'border-warning-300 dark:border-warningn-600',
                'outlined' => "border-warningn-600 dark:border-warningen-700",
            ],
            'danger' => [
                'default' => 'border-danger-300 dark:border-danger-600',
                'outlined' => "border-danger-600 dark:border-danger-700",
            ],
            'info' => [
                'default' => 'border-info-300 dark:border-info-600',
                'outlined' => "border-info-600 dark:border-info-700",
            ],
            // Add more border colors here
        ];

        return $outlined ? $borderClasses[$color]['outlined'] : $borderClasses['neutral']['default'];
    }

    // Consolidated hover classes method
    public static function getHoverClasses($color, $outlined, $component = 'default')
    {
        $hoverVariants = [
            'black' => [
                'default' => "hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black",
                'outlined' => "hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black",
            ],
            'white' => [
                'default' => "hover:bg-white hover:text-black dark:hover:bg-black dark:hover:text-white",
                'outlined' => "hover:bg-white hover:text-black dark:hover:bg-black dark:hover:text-white",
            ],
            'red' => [
                'default' => "hover:bg-red-600 hover:text-white dark:hover:bg-red-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900 dark:hover:text-red-200",
            ],
            'green' => [
                'default' => "hover:bg-green-600 hover:text-white dark:hover:bg-green-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-green-50 hover:text-green-700 dark:hover:bg-green-900 dark:hover:text-green-200",
            ],
            'neutral' => [
                'default' => "hover:bg-neutral-600 hover:text-white dark:hover:bg-neutral-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-neutral-50 hover:text-neutral-700 dark:hover:bg-neutral-900 dark:hover:text-neutral-200",
            ],
            'indigo' => [
                'default' => "hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-indigo-50 hover:text-indigo-700 dark:hover:bg-indigo-900 dark:hover:text-indigo-200",
            ],
            'yellow' => [
                'default' => "hover:bg-yellow-600 hover:text-white dark:hover:bg-yellow-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-yellow-50 hover:text-yellow-700 dark:hover:bg-yellow-900 dark:hover:text-yellow-200",
            ],
            'blue' => [
                'default' => "hover:bg-blue-600 hover:text-white dark:hover:bg-blue-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-blue-50 hover:text-blue-700 dark:hover:bg-blue-900 dark:hover:text-blue-200",
            ],
            'gray' => [
                'default' => "hover:bg-gray-600 hover:text-white dark:hover:bg-gray-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-gray-50 hover:text-gray-700 dark:hover:bg-gray-900 dark:hover:text-gray-200",
            ],
            'primary' => [
                'default' => "hover:bg-primary-600 hover:text-white dark:hover:bg-primary-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-primary-50 hover:text-primary-700 dark:hover:bg-primary-900 dark:hover:text-primary-200",
            ],
            'secondary' => [
                'default' => "hover:bg-secondary-600 hover:text-white dark:hover:bg-secondary-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-secondary-50 hover:text-secondary-700 dark:hover:bg-secondary-900 dark:hover:text-secondary-200",
            ],
            'info' => [
                'default' => "hover:bg-info-600 hover:text-white dark:hover:bg-info-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-info-50 hover:text-info-700 dark:hover:bg-info-900 dark:hover:text-info-200",
            ],
            'warning' => [
                'default' => "hover:bg-warning-600 hover:text-white dark:hover:bg-warning-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-warning-50 hover:text-warning-700 dark:hover:bg-warning-900 dark:hover:text-warning-200",
            ],
            'success' => [
                'default' => "hover:bg-success-600 hover:text-white dark:hover:bg-success-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-success-50 hover:text-success-700 dark:hover:bg-success-900 dark:hover:text-success-200",
            ],
            'danger' => [
                'default' => "hover:bg-danger-600 hover:text-white dark:hover:bg-danger-800 dark:hover:text-neutral-200",
                'outlined' => "hover:bg-danger-50 hover:text-danger-700 dark:hover:bg-danger-900 dark:hover:text-danger-200",
            ],
            // Add more colors here if necessary
        ];

        // Default hover classes to fall back on if a specific color is not defined
        $defaultHoverClasses = [
            'default' => "hover:bg-gray-600 hover:text-white dark:hover:bg-gray-800 dark:hover:text-neutral-200",
            'outlined' => "hover:bg-gray-50 hover:text-gray-700 dark:hover:bg-gray-900 dark:hover:text-gray-200",
        ];

        // Determine the variant based on whether it's outlined or not
        $variant = $outlined ? 'outlined' : 'default';

        // Return the hover classes for the specified color, or fall back to the default hover classes
        return $hoverVariants[$color][$variant] ?? $defaultHoverClasses[$variant];
    }

    // Consolidated background class method
    public static function getBackgroundClass($disabled, $readonly)
    {
        return ($disabled || $readonly) ? 'bg-neutral-100 dark:bg-neutral-800' : '';
    }

    // Consolidated error and text color method
    public static function getTextAndErrorClass($error, $errors, $name)
    {
        $hasError = $error || ($name && $errors->has($name));
        return $hasError ? 'text-red-600 dark:text-red-700' : 'text-neutral-700 dark:text-neutral-300';
    }

    // Consolidated rounded classes method
    public static function getRoundedClass($rounded, $component = 'default')
    {
        $roundedClasses = [
            'button' => $rounded ? 'rounded-full' : 'rounded-md',
            'avatar' => $rounded ? 'rounded-full' : 'rounded-md',
            'card' => 'rounded-lg',
            'default' => $rounded ? 'rounded-md' : '',
        ];

        return $roundedClasses[$component] ?? $roundedClasses['default'];
    }

    // Consolidated error message classes
    public static function getErrorMessageClass()
    {
        return 'text-sm text-red-600';
    }

    // Get classes for specific components
    public static function getButtonClasses($size, $color, $outlined, $rounded, $disabled, $loading, $fullWidth = false)
    {
        $baseClasses = 'inline-flex items-center justify-center font-medium focus:outline-none transition ease-in-out duration-150';
        $loadingClasses = $loading ? 'relative' : '';
        $sizeClass = self::getSizeClass('button', $size);
        $roundedClasses = self::getRoundedClass($rounded, 'button');
        $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';
        $colorClasses = self::getColorClasses($color, $outlined);
        $fullWidthClassses = $fullWidth ? 'w-full' : '';
        $hoverClasses = self::getHoverClasses($color, $outlined, 'button');

        return implode(' ', [
            $baseClasses,
            $loadingClasses,
            $sizeClass,
            $colorClasses,
            $roundedClasses,
            $disabledClasses,
            $fullWidthClassses,
            $hoverClasses,
        ]);
    }

    public static function getTextAreaClasses($size, $disabled, $readonly, $error, $errors, $name)
    {
        $sizeClass = self::getSizeClass('textarea', $size);
        $disabledClass = $disabled ? 'bg-neutral-100 cursor-not-allowed' : '';
        $readonlyClass = $readonly ? 'bg-neutral-100' : '';
        $errorClass = self::getTextAndErrorClass($error, $errors, $name);
        $baseClasses = 'block w-full shadow-xs placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-gray-500 dark:focus:border-gray-500 rounded-md';
        $backgroundClass = self::getBackgroundClass($disabled, $readonly);
        $darkPlaceholderClass = 'dark:placeholder-neutral-600';

        return implode(' ', [
            $baseClasses,
            $sizeClass,
            $backgroundClass,
            $darkPlaceholderClass,
            $disabledClass,
            $readonlyClass,
            $errorClass,
        ]);
    }

    public static function getAlertClasses($size, $color, $outlined, $fullWidth)
    {
        $sizeClass = self::getSizeClass('alert', $size);
        $colorClasses = self::getColorClasses($color, $outlined, 'alert');
        $fullWidthClass = $fullWidth ? 'w-full mx-0 px-2' : 'rounded-md shadow-sm';

        return implode(' ', [$sizeClass, $colorClasses, $fullWidthClass]);
    }

    public static function getHeaderClasses($size, $color, $shadow, $fullWidth)
    {
        $sizeClass = self::getSizeClass('header', $size);
        $colorClasses = self::getColorClasses($color, false, 'header');
        $fullWidthClass = $fullWidth ? 'w-full mx-0 px-2' : 'rounded-md';
        $shadowClass = $shadow ? 'shadow-xs' : '';

        return implode(' ', [$sizeClass, $colorClasses, $fullWidthClass, $shadowClass]);
    }

    public static function getAvatarClasses($size, $color, $rounded, $outlined)
    {
        $sizeClass = self::getSizeClass('avatar', $size);
        $roundedClass = self::getRoundedClass($rounded, 'avatar');
        $bgColorClass = self::getColorClasses($color, $outlined);

        return implode(' ', [$sizeClass, $roundedClass, $bgColorClass]);
    }

    public static function getBadgeClasses($size, $color, $outlined, $rounded)
    {
        $sizeClass = self::getSizeClass('badge', $size);
        $colorClass = self::getColorClasses($color, $outlined);
        $roundedClass = self::getRoundedClass($rounded);

        return implode(' ', ["font-medium tracking-wide inline-flex items-center justify-center", $sizeClass, $colorClass, $roundedClass]);
    }

    public static function getCardClasses($size, $color, $outlined)
    {
        $sizeClass = self::getSizeClass('card', $size);
        $colorClass = self::getColorClasses($color, $outlined, 'card');
        $roundedClass = self::getRoundedClass(false, 'card');

        return implode(' ', [$sizeClass, $colorClass, $roundedClass]);
    }

    public static function getCheckboxClasses($size, $name, $errors, $errorOverride)
    {
        $sizeClass = self::getSizeClass('checkbox', $size);
        $errorClass = self::getTextAndErrorClass($errorOverride, $errors, $name);
        $focusClass = 'focus:ring-indigo-500';
        $textColorClass = 'text-indigo-600';
        $roundedClass = self::getRoundedClass(false, 'checkbox');

        return implode(' ', [
            'ml-1 mt-1',
            $focusClass,
            $sizeClass,
            $textColorClass,
            $errorClass,
            $roundedClass,
        ]);
    }

    // Label class method (specific to form components)
    public static function getLabelClass($name, $errors, $errorOverride)
    {
        return self::getTextAndErrorClass($errorOverride, $errors, $name);
    }

    // Help text class method (for forms)
    public static function getHelpTextClass()
    {
        return 'text-neutral-500 dark:text-neutral-400 mt-1 text-sm';
    }

    // Dismiss button class for alerts
    public static function getDismissButtonClass()
    {
        return 'text-current hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 dark:hover:text-neutral-300';
    }

    // Status indicator classes for avatars
    public static function getStatusClass($status)
    {
        $statusColors = [
            'online' => 'bg-green-500',
            'offline' => 'bg-neutral-500',
            'busy' => 'bg-red-500',
        ];

        return $status ? ($statusColors[$status] ?? 'bg-neutral-500') : null;
    }

    // Drawer classes
    public static function getDrawerClasses($size, $color, $outlined, $position, $backdrop) {
        $dimensionClasses = self::getSizeClass('drawer', $size);
        $colorClass = self::getColorClasses($color, $outlined);
        $positionClass = $position === 'right' ? 'right-0 top-0 h-full' : 'left-0 top-0 h-full';
        $zIndex = $backdrop ? 'z-50' : 'z-30';
        $transitionClass = 'transition-transform ease-in-out duration-300 shadow-lg';

        return implode(' ', [$positionClass, $dimensionClasses, $colorClass, $transitionClass, $zIndex]);
    }

    public static function getDrawerVisibilityClasses($position, $backdrop) {
        $positionClass = $position === 'right' ? 'right-0 top-0 h-full' : 'left-0 top-0 h-full';
        $zIndex = $backdrop ? 'z-50' : 'z-30';
        $transitionClass = 'transition-transform ease-in-out duration-300 shadow-lg';

        return implode(' ', [$positionClass, $transitionClass, $zIndex]);
    }

    public static function getBackdropClass($backdrop) {
        $zIndex = $backdrop ? 'z-50' : 'z-30';
        $backdropClass = 'fixed inset-0 bg-black bg-opacity-50 transition-opacity ease-in-out duration-300';

        return implode(' ', [$backdropClass, $zIndex]);
    }

    public static function getSelectClasses($size, $disabled) {
        $sizeClass = self::getSizeClass('select', $size);
        $disabledClass = $disabled ? 'opacity-50 cursor-not-allowed' : '';
        $baseClasses = 'block w-full border border-neutral-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500';
        $darkModeClasses = 'dark:bg-black dark:text-white dark:border-neutral-900';

        return implode(' ', [$baseClasses, $sizeClass, $disabledClass, $darkModeClasses]);
    }

    public static function getSelectLabelClasses($size, $errorMessage) {
        $labelTextSize = self::getSizeClass('select', $size);
        $baseLabelClasses = 'block font-medium text-neutral-700 dark:text-neutral-300';
        $errorClass = $errorMessage ? 'text-red-600' : '';

        return implode(' ', [$baseLabelClasses, $labelTextSize, $errorClass]);
    }

    // Methods for radio buttons
    public static function getRadioButtonClasses($size, $errorMessage) {
        $sizeClass = self::getSizeClass('radio', $size);
        $errorClass = $errorMessage ? 'border-red-500' : 'border-neutral-300';
        $baseClasses = "ml-1 mt-1 text-indigo-600 focus:ring-indigo-500 rounded-full";

        return implode(' ', [$baseClasses, $sizeClass, $errorClass]);
    }

    public static function getRadioLabelClass($errorMessage) {
        return $errorMessage ? 'text-red-600' : 'text-neutral-900 dark:text-neutral-300';
    }

    public static function getRadioHelpTextClass() {
        return 'text-neutral-500 dark:text-neutral-400 mt-1 text-sm';
    }

    public static function getRadioErrorMessageClass() {
        return 'text-sm text-red-600';
    }

    // Navbar class consolidation
    public static function getNavbarClasses() {
        return 'border-b-[1px] flex py-3 items-center space-x-8 max-w-full w-full px-2 bg-white text-neutral-900 dark:bg-black dark:text-neutral-100 dark:border-neutral-900/60';
    }

    public static function getShellPrimarySidebarClasses() {
        return 'flex flex-col w-14 lg:w-16 items-center py-4 bg-neutral-200 dark:bg-black';
    }

    public static function getShellSecondarySidebarClasses() {
        $baseClasses = 'transition-width duration-300 overflow-hidden bg-neutral-100 dark:bg-black dark:border-l-[1px] dark:border-neutral-900/60 dark:border-r-[1px] h-full';

        return implode(' ', [$baseClasses]);
    }

    public static function getShellMainContentClasses() {
        return 'flex-1 flex flex-col';
    }

    public static function getShellNavBarClasses() {
        return 'bg-white dark:bg-black';
    }

    public static function getShellPageContentClasses() {
        return 'flex-1 overflow-y-auto bg-white dark:bg-black w-full';
    }

    public static function getToggleColorClass($color, $outlined) {
        if (in_array($color, ['black', 'white'])) {
            return $color === 'black'
                ? 'peer-checked:bg-black peer-focus:ring-neutral-500 dark:peer-checked:bg-black dark:peer-focus:ring-neutral-700'
                : 'peer-checked:bg-white peer-focus:ring-neutral-300 dark:peer-checked:bg-neutral-200 dark:peer-focus:ring-neutral-600';
        } else {
            return "peer-checked:bg-{$color}-600 peer-focus:ring-{$color}-300 dark:peer-checked:bg-{$color}-700 dark:peer-focus:ring-{$color}-800";
        }
    }

    public static function getToggleClasses($size, $color, $outlined) {
        $sizeClass = self::getSizeClass('toggle', $size);
        $colorClass = self::getToggleColorClass($color, $outlined);
        return implode(' ', ['bg-neutral-200 rounded-full peer dark:bg-neutral-700 peer-focus:outline-none peer-focus:ring-4', $sizeClass, $colorClass]);
    }
    
    public static function getTableClasses($hoverable = false, $responsive = false, $borderSize = 'normal') {
        $baseClasses = 'min-w-full divide-y divide-gray-200';
        $hoverClasses = $hoverable ? 'hover:bg-gray-100' : '';
        $responsiveClasses = $responsive ? 'table-responsive' : '';
        $borderClasses = match($borderSize) {
            'none' => 'border-0',
            'small' => 'border-2',
            'large' => 'border-8',
            default => 'border'
        };

        return implode(' ', [$baseClasses, $hoverClasses, $responsiveClasses, $borderClasses]);
    }

    public static function getTableHeaderClasses() {
        return 'bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider';
    }

    public static function getTableCellClasses() {
        return 'px-6 py-4 whitespace-nowrap text-sm text-gray-500';
    }

    public static function getTableFooterClasses() {
        return 'bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider';
    }

    public static function getTableBodyClasses() {
        return 'bg-white divide-y divide-gray-200';
    }
}
