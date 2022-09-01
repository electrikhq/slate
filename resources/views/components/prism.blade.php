@props([
	'lang' => null,
])

@if($code)
<pre>
	<code class="language-{{ $lang }}">
		{{ $code }}
	</code>
</pre>
@endif

@once
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism.min.css" integrity="sha512-tN7Ec6zAFaVSG3TpNAKtk4DOHNpSwKHxxrsiw4GHKESGPs5njn/0sMCUMl2svV4wo4BK/rCP7juYz+zx+l6oeQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://raw.githubusercontent.com/PrismJS/prism-themes/master/themes/prism-ghcolors.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endonce

@once
<script src="https://unpkg.com/prismjs@1.15.0/components/prism-core.min.js"></script>
<script src="https://unpkg.com/prismjs@1.15.0/plugins/autoloader/prism-autoloader.min.js"></script>
<script>
    Prism.plugins.autoloader.languages_path = 'https://unpkg.com/prismjs@1.15.0/components/'
</script>
@endonce

@push('styles')