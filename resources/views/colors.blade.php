@foreach($colors as $color)
    .sys_{{ ($color->color_name) }} {
    background-color: #{{ $color->color_bg_hex }};
    color: #{{ $color->color_txt_hex }};
    }
@endforeach
