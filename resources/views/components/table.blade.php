@props([

])
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block py-2 min-w-full px-1">
            <div class="overflow-hidden shadow">
				<table class="min-w-full divide-y divide-gray-100">
					<thead class="bg-gray-100">
            			<tr>
							{{ $head }}
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-100">
						{{ $slot }}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>