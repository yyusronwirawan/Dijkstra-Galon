<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary','form']) }}>
    {{ $slot }}
</button>
