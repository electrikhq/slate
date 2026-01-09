{{-- step.blade.php --}}
@props([
    'index' => 0,
    'label' => null,
    'description' => null,
    'completed' => false,
])

<div
    x-data="{
        get stepperData() {
            const stepper = this.$el.closest('[x-data]');
            return stepper && stepper.__x ? stepper.__x.$data : null;
        },
        get isCurrent() {
            const data = this.stepperData;
            return data && data.current === {{ $index }};
        },
        get isCompleted() {
            const data = this.stepperData;
            return {{ $completed ? 'true' : 'false' }} || (data && data.current > {{ $index }});
        },
        get isUpcoming() {
            const data = this.stepperData;
            return data && data.current < {{ $index }};
        }
    }"
    data-step
    {{ $attributes->merge(['class' => 'relative flex items-center']) }}
>
    <div class="flex items-center">
        <div
            :class="{
                'bg-primary text-primary-foreground': isCurrent,
                'bg-primary text-primary-foreground': isCompleted,
                'bg-muted text-muted-foreground': isUpcoming
            }"
            class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-border transition-colors"
        >
            <template x-if="isCompleted">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M20 6L9 17l-5-5" />
                </svg>
            </template>
            <template x-if="!isCompleted">
                <span x-text="{{ $index }} + 1"></span>
            </template>
        </div>
        @if($label || $description)
            <div class="ml-4">
                @if($label)
                    <div
                        :class="{
                            'text-foreground font-medium': isCurrent,
                            'text-muted-foreground': !isCurrent
                        }"
                        class="text-sm font-medium"
                    >
                        {{ $label }}
                    </div>
                @endif
                @if($description)
                    <div class="text-xs text-muted-foreground">{{ $description }}</div>
                @endif
            </div>
        @endif
    </div>
    {{ $slot }}
</div>

