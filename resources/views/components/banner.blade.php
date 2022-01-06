@props([
	'color' => 'primary',
	'sticky' => null,
	'floating' => null,
	'bottom' => null,
	'icon' => null,
	'heading' => null,
	'actions' => null,
	'dismissable' => null,
])

<div 
	x-data="{ show: true }"
	x-show='show'
>

@if($sticky)
<div class="fixed inset-x-0 {{ (!$bottom) ? 'top' : 'bottom'  }}-0 z-50">
@elseif($floating)
<div class="fixed {{ (!$bottom) ? 'top' : 'bottom'  }}-0 inset-x-0 pb-2 sm:pb-5 z-50">
@else
<div {{ $attributes
		->class([
			'bg-primary-600' => ($color == "primary"),
			'bg-secondary-600' => ($color == "secondary"),
			'bg-success-600' => ($color == "success"),
			'bg-warning-600' => ($color == "warning"),
			'bg-danger-600' => ($color == "danger"),
			'bg-info-600' => ($color == "info"),
		])
	}}
>
@endif

    <div {{ $attributes
		->class([
			"mx-auto py-6 px-3 sm:px-6 lg:px-8",
			"max-w-screen-".$attributes->get('size'),
		])
	}}>
		@if($floating)
		<div 
		{{ $attributes
			->class([
				"p-2 rounded-lg  shadow-lg sm:p-3",
				'bg-primary-600' => ($color == "primary"),
				'bg-secondary-600' => ($color == "secondary"),
				'bg-success-600' => ($color == "success"),
				'bg-warning-600' => ($color == "warning"),
				'bg-danger-600' => ($color == "danger"),
				'bg-info-600' => ($color == "info"),
			])
		}}>
		@endif
		
		<div class="flex items-center justify-between flex-wrap">
		

            <div class="w-0 flex-1 flex items-center">
                
				<div class="shrink-0">
					<x-slate::icon :icon="$icon" color="white" size="sm" />
				</div>

				@if($text)
               	 	<div class="ml-3 font-medium text-white truncate">

						{{ $text}}

					</div>
				@endif
            </div>
			@if($actions)
            <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
				{{ 
					$actions
				}}
            </div>
			@endif
			@if($dismissable)
            <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                <button type="button"
					@click="show = false"
					x-transition
					{{ $attributes->class([
						'-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition ease-in-out duration-150',
						'hover:bg-primary-500 focus:bg-primary-500' => ($color == "primary"),
						'hover:bg-secondary-500 focus:bg-secondary-500' => ($color == "secondary"),
						'hover:bg-warning-500 focus:bg-warning-500' => ($color == "warning"),
						'hover:bg-success-500 focus:bg-success-500' => ($color == "success"),
						'hover:bg-danger-500 focus:bg-danger-500' => ($color == "danger"),
						'hover:bg-info-500 focus:bg-info-500' => ($color == "info"),
					]) }}
				>
                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
			@endif
			
        </div>
		@if($floating)
			</div>
		@endif

    </div>

@if($sticky || $floating)
</div>
@else 
</div>
@endif
</div>