<div  {{ $attributes->merge(['class' => 'alert text-white alert-dismissible fade show']) }} role="alert">
  {{ $slot }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
