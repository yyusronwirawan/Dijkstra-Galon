@props(['style' => 'width:35px;height:35px;object-fit: cover;'])
<img src="{{ asset('img/default/default.png') }}" {{ $attributes->merge(['class' => '']) }}  style="{{ $style }}" />
